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

	public function getIndex()
	{
		$users = User::all();
		$members = Member::paginate(10);
		return view('members.index')->with('members', $members)->with('users', $users);//->with('user', $persons);
	}

	public function getRegister(){
		$members = new Member();
		return view('members.register');//->with('member', $members);
	}

	public function postRegister(){
		$validator = Validator::make(Request::all(), Member::$rules);
		if ($validator->passes()) 
		{
	    	// validation has passed, save member in DB
			$person = new Member;
		    $person->firstname = Request::input('firstname');
		    $person->lastname = Request::input('lastname');
		    $person->birthdate = strtotime(Request::input('birthdate'));  
		    $person->onlinename = Request::input('onlinename');	   	
			$person->save();
		    return redirect('members')->with('message', 'success|Student erfolgreich angelegt!');
		} 
		else
	 	{
	 
	 		
	    	// validation has failed, display error messages   
	    	return redirect('members/register')->with('message', 'danger|Die folgenden Fehler sind aufgetreten:')->withErrors($validator)->withInput();
		}
	}

	public function getAdduser($member_id){
		$user = Auth::user();		
		if($user->permission == 0){	//permission == 0 => admin
			/*$users = User::all();
			$containsUser = false;
			foreach ($users as $u) {
				if($u->member_id == $member_id){
					$containsUser = true;
			    	echo $u->username;
			    }
			}*/

			$model = User::where('member_id', $member_id)->first();
		//	echo var_dump($model);
			//$flights = User::where('active', 0)
               //->orderBy('name', 'desc')
               //->take(10)
            //   ->get();exit;
			//$user = User::contains();
			//var_dump($user);exit;
			//if ($user->contains($member_id)) {
			//if($containsUser){
			if($model != NULL){
			//if(User::contains($member_id)){		
				echo '<script>alert("zufügenButton nicht sichtbar, du aber üeber url...");</script>';	
				echo 'asdas';	
				return redirect('members');
			}
			else{	
				$member = Member::find($member_id);			
				return view('users.register')->with('member', $member);//->with('user', $persons);	
			}
		}
		else{
			//alert('nope kein permission! gibts was schoeneres als alert??');
		}
	}

	public function getEditmember($member_id){
		$member = Member::find($member_id);
		return view('members.editmember')->with('member', $member);
	}

	public function postEditmember($member_id){
        $rules = Member::$rules;
        $rules['onlinename'] = 'required|unique:members,onlinename,'.$member_id;
		$validator = Validator::make(Request::all(), $rules);
		if ($validator->passes()) 
		{
	    	// validation has passed, save user in DB
			$member = Member::find($member_id);
		    $member->firstname = Request::input('firstname');
		    $member->lastname = Request::input('lastname');
		    $member->onlinename = Request::input('onlinename');
		    $member->birthdate = strtotime(Request::input('birthdate')); 
			$member->save();
		    return redirect('members')->with('message', 'success|Student erfolgreich angelegt!');
		} 
		else
	 	{
	    	// validation has failed, display error messages   
	    	return redirect('members/editmember/'. $member_id)->with('message', 'danger|Die folgenden Fehler sind aufgetreten:')->withErrors($validator)->withInput();
		}
	}
}
