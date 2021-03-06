<?php

namespace App\Http\Controllers;
use App\Models\Kigo;
use App\Models\Sermon;
use App\Models\User;
use App\Models\Person;
use App\Models\Message;
use App\Models\Member;
use App\Models\Sundayservice;

use Validator;
use View;
use Request;
use Hash;
use Auth;

class UserController extends Controller
{

	public function getIndex()
	{		
		$user = Auth::user();
		$birthdays = Member::all();		
		$newMessages = $user->newMessages($user);
		
		$today = time();
		
		$predigten = User::getSermonsByIdAndDate($user->member_id, $today);

			/*** Fehler beim Auslagern ins Model ***/
		$lektors = User::getSundayservicesByIdAndDate($user->user_id, $today);
		$kigos = User::getKigosByIdAndDate($user->user_id, $today);


		$lektors= Sundayservice::whereHas('sermons', function($q) use ($today)
				{
				    $q->where('date','>=',$today);

				})->where('user_id','=',$user->id)->get();

		$kigos = Kigo::whereHas('sundayservices', function($q) use ($today)
				{
				    $q->whereHas('sermons', function($q2) use ($today)
				    	{
				    		 $q2->where('date','>=',$today);
				    	});

				})->where('user_id','=',$user->id)->get();
		

		return view('users.index')->with('user', $user)->with('birthdays', $birthdays)->with('sermons', $predigten)->with('kigos', $kigos)->with('lektors', $lektors)->with('newMessages', $newMessages);
	}

	public function postRegister($member_id){
		$validator = Validator::make(Request::all(), User::$rules);
    	$user = new User;
		$user->member_id = $member_id;
    	if ($validator->passes()) 
    	{
        	// validation has passed, save user in DB
        	$user->id = $member_id;
		    $user->username = Request::input('username');   	
		    $user->password = Hash::make(Request::input('password'));
		    $user->permission = intval(Request::input('permission'));		
		    $user->save();
		    return redirect('members')->with('message', 'success|'.$user->username.' erfolgreich als Mitarbeiter angelegt!');
    	} 
    	else
     	{
        	// validation has failed, display error messages   
        	return redirect('members/adduser/'.$user->member_id)->with('message', 'danger|Die folgenden Fehler sind aufgetreten:')->withErrors($validator)->withInput();
        	//eig. members/register sinniger
    	}
	}

	public function getEdituser ($user_id){
		$auth_user = Auth::user();
		$user = User::find($user_id);
		$member = Member::find($user->member_id);
		return view('users.edituser')->with('user', $user)->with('member', $member)->with('auth_user', $auth_user);
	}

	public function postEdituser ($user_id){	
		$auth_user = Auth::user();
		$user = User::find($user_id);
        $rules = User::$rules;
        //$rules['username'] = 'required|alpha|min:2|unique:users,username,'.$user_id;
        $rules['firstname'] = 'required|alpha|min:2';
		$rules['lastname'] = 'required|alpha|min:2';
		$rules['onlinename'] = 'required|unique:members,onlinename,'.$user->member_id;
		$rules['birthdate'] = 'date_format:d.m.Y';
        $rules['username'] = 'required|alpha|min:2|unique:users,username,'.$user_id;        
        $rules['password'] = '';
        $rules['password_confirmation'] = '';
        $rules['email'] = 'email|unique:members,email,'.$user_id;
        if(!($auth_user->permission == 0 && $auth_user->id != $user->id)){
        	$rules['permission'] = '';
        }        
        $validator = Validator::make(Request::all(), $rules);
 		
        if ($validator->passes()) 
        {
            // validation has passed, save user in DB    
            $member = Member::find($user->member_id);
            //$user->member_id = Request::input('member_id');
            $member->firstname = Request::input('firstname');
            $member->lastname = Request::input('lastname');
            $member->onlinename = Request::input('onlinename');
            $member->birthdate = strtotime(Request::input('birthdate'));  
            $member->email = Request::input('email');	
            $user->username = Request::input('username');		       	
		    if($auth_user->permission == 0 && $auth_user->id != $user->id){
		    	$user->permission = intval(Request::input('permission'));
		    }
		    $member->save();
            $user->save();
            return redirect('members')->with('message', 'success|Mitarbeiter erfolgreich bearbeitet!');
        }
        else 
        {
            // validation has failed, display error messages   
            return redirect('users/edituser/'.$user_id)->with('message', 'danger|Die folgenden Fehler sind aufgetreten:')->withErrors($validator)->withInput();
        }
	}

	public function getEditpassword ($user_id){
		$auth_user = Auth::user();
		$user = User::find($user_id);
		$member = Member::find($user->member_id);
		return view('users.editpassword')->with('user', $user)->with('member', $member)->with('auth_user', $auth_user);
	}

	public function postEditpassword ($user_id){	
        $rules = User::$rules;
        $rules['username'] = ''.$user_id;
        $rules['password'] = 'required|alpha_num|between:6,12|confirmed';
        $rules['password_confirmation'] = 'required|alpha_num|between:6,12';
        $rules['email'] = '';
        $rules['permission'] = '';
        $rules['member_id'] = '';
        $validator = Validator::make(Request::all(), $rules);
 		
        if ($validator->passes()) 
        {
            // validation has passed, save user in DB
            $user = User::find($user_id);
		    $user->password = Hash::make(Request::input('password'));
            $user->save();         
            return redirect('members')->with('message', 'success|Passwort erfolgreich geändert!');
        }
        else 
        {
            // validation has failed, display error messages   
            return redirect('users/editpassword/'.$user_id)->with('message', 'danger|Die folgenden Fehler sind aufgetreten:')->withErrors($validator)->withInput();
        }
	}

	public function getDeleteuser($user_id){
		$auth_user = Auth::user();
		$users = User::all();
		if($auth_user->permission == 0 && $auth_user->id != $user_id){
			$user = User::find($user_id);
			
			//reset all foreign ids reffering to the user in kigo, sermon (member->sermon), sunday, 
			foreach ($user->kigos as $kigo) {
				$kigo->user_id = 0;
				$kigo->save();
			}
			foreach ($user->sundayservices as $sunday) {
				$sunday->user_id = 0;
				$sunday->save(); 
			}
			//foreach ($user->members->sermons as $sermon) {
				//$sermon->preacher_id = 0;
				//$sermon->save();
			//}
			$user->delete();
		}				
		return redirect('members')->with('users', $users)->with('auth_user', $auth_user);
	}
}
