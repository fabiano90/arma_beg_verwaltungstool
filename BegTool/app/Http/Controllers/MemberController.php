<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Member;
use App\Models\Message;
use Validator;
use View;
use Request;
use Hash;
use Auth;

class MemberController extends Controller
{

	public function getIndex(){
		$auth_user = Auth::user();
		$newMessages = $auth_user->newMessages($auth_user);
		
		$users = User::all();
		$members = Member::all();
		return view('members.index')->with('newMessages', $newMessages)->with('members', $members)->with('users', $users)->with('auth_user', $auth_user);//->with('user', $persons);
	}

	public function getRegister(){
		$auth_user = Auth::user();

		if($auth_user->permission != 0){	
			return redirect('members')->with('message', 'danger|Sie sind nicht berechtig neue Mitglieder anzulegen!');			
		}
		$members = new Member();		
		$newMessages = $auth_user->newMessages($auth_user);
		return view('members.register')->with('newMessages', $newMessages);
	}

	public function postRegister(){
		$validator = Validator::make(Request::all(), Member::$rules);
		if ($validator->passes()) 
		{
	    	// validation has passed, save member in DB
			$member = new Member;
		    $member->firstname = Request::input('firstname');
		    $member->lastname = Request::input('lastname');
		    $member->birthdate = strtotime(Request::input('birthdate'));  
		    $member->onlinename = Request::input('onlinename');	   	
		    $member->email = Request::input('email');
			$member->save();
		    return redirect('members')->with('message', 'success|Gemeindemitglied erfolgreich angelegt!');
		} 
		else
	 	{	 
	    	// validation has failed, display error messages   
	    	return redirect('members/register')->with('message', 'danger|Die folgenden Fehler sind aufgetreten:')->withErrors($validator)->withInput();
		}
	}

	public function getAdduser($member_id){
		$auth_user = Auth::user();		
		if($auth_user->permission != 0){	
			return redirect('members')->with('message', 'danger|Sie sind nicht berechtig Mitglieder als Mitarbeiter hinzuzufügen!');			
		}
		$newMessages = $auth_user->newMessages($auth_user);	
		$member = Member::find($member_id);			
		return view('users.register')->with('newMessages', $newMessages)->with('member', $member);		
	}

	public function getEditmember($member_id){
		$auth_user = Auth::user();
		$newMessages = $auth_user->newMessages($auth_user);
		if($auth_user->permission != 0){
			return redirect('members')->with('message', 'danger|Sie sind nicht berechtig Mitglieder zu bearbeiten!');
		}
		$member = Member::find($member_id);		
		return view('members.editmember')->with('newMessages', $newMessages)->with('member', $member)->with('auth_user', $auth_user);
	}

	public function postEditmember($member_id){
        $rules = Member::$rules;
		$validator = Validator::make(Request::all(), $rules);
		if ($validator->passes()) 
		{
	    	// validation has passed, save user in DB
			$member = Member::find($member_id);
		    $member->firstname = Request::input('firstname');
		    $member->lastname = Request::input('lastname');
		    $member->onlinename = Request::input('onlinename');
		    $member->birthdate = strtotime(Request::input('birthdate')); 
		    $member->email = Request::input('email');
			$member->save();
		    return redirect('members')->with('message', 'success|Mitglied erfolgreich bearbeitet!');
		} 
		else
	 	{
	    	// validation has failed, display error messages   
	    	return redirect('members/editmember/'. $member_id)->with('message', 'danger|Die folgenden Fehler sind aufgetreten:')->withErrors($validator)->withInput();
		}
	}

	public function getDeletemember($member_id){
		$auth_user = Auth::user();
		$member = Member::find($member_id);
		if($auth_user->permission == 0 && $auth_user->member_id != $member_id && $member != null){
			$user = $member->users;					
			//if useraccount exists, reset all foreign ids referring to the user in kigo, sermon (member->sermon), sunday
							//$user = User::where('member_id', '=', $member_id)->get();
							//if(!$user->isEmpty()){//with query builder $user = User::where('member_id', '=', $member_id)->get(); needs additional foreach
			if($user != null){				
				foreach ($user->kigos as $kigo) {
					$kigo->user_id = 0;
					$kigo->save();
				}
				foreach ($user->sundayservices as $sunday) {
					$sunday->user_id = 0;
					$sunday->save(); 
				}
				/*foreach ($user->members->sermons as $sermon) {
					$sermon->preacher_id = 0;
					$sermon->save();
				}*/
				$user->delete();
			}			
			/*foreach ($member->sermons as $sermon) {
				$sermon->preacher_id = 0;
				$sermon->save();
			}*/
			$member->deleted = date('Y-m-d h:m:s');
			$member->save();
			//$member->delete($member_id);				
		}
		$users = User::all();
		$members = Member::all();
		return redirect('members');
	}
}
