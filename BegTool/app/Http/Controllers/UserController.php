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
use DB;

class UserController extends Controller
{

	public function getIndex()
	{
		
		$user = Auth::user();
		$today=time();
		//$kigos=$user->sundayservices->sermons->where('user_id','=',$user->id)->get();
		//echo date('d.m.Y',time());exit;
		$kigos=Kigo::where('user_id','=',$user->id)->get();
		$predigten=Sermon::where('preacher_id','=', $user->member_id)->where('date','>=',$today)->get();
		$lektors=Sundayservice::whereHas('sermons', function($q) use ($today)
				{
				    $q->where('date','>=',$today);

				})->where('user_id','=',$user->id)->get();

		$kigos2 = Kigo::has('sundayservices')->where('user_id','=', $user->id)->get();

		$kigos3=Sundayservice::whereHas('sermons', function($q) use ($today)
				{
				    $q->where('date','>=',$today);

				})->has('kigos')->where('user_id', '=', $user->id)->get();


		/*->whereHas('kigos', function($q) use ($today)


				{
				    $q->where('date','>=',$today);

				})->where('user_id','=',$user->id)->get();*/

		/*echo $user.'<br>';
			$user = 24;
		//$services = Sundayservice::all();
		//$services->kigos->where('user_id','=',$user->id)->get();

		$services = Sundayservice::whereHas('kigos', function($q) use ($user)
				{
				    $q->where('user_id', 'like', $user);

				})->orWhere('user_id', 'like', $user)
				  ->get();
		echo var_dump($services);

		foreach ($services as $service) {
			//echo $service->kigos()->where('user_id','=',$user->id)->get();
			echo '('.$service->kigos->user_id.') ';	
			echo date('d.m.Y',$service->sermons->date);
			echo $service->users->username;
			echo '<br>'	;
		}
		exit;*/

		return view('users.index')->with('user', $user)->with('sermons', $predigten)->with('kigos', $kigos3)->with('lektors', $lektors);//->with('jaja', $jaja);
	}

	public function getUserlist()
	{

		$users = User::paginate(15);		
		return view('users.userlist')->with('users', $users);//->with('jaja', $jaja);
	}

	public function getRegister(){
		$user = new User();
		return view('users.register')->with('user', $user);
	}

	public function postRegister(){
		$validator = Validator::make(Request::all(), User::$rules);
    	$user = new User;
		$user->member_id = Request::input('member_id');
    	if ($validator->passes()) 
    	{
        	// validation has passed, save user in DB
		    $user->username = Request::input('username');
		    $user->email = Request::input('email');		   	
		    $user->password = Hash::make(Request::input('password'));
		    $user->permission = intval(Request::input('permission'));
		   

		   echo 
		    "member_id: " . $user->member_id.
		    " username: ". $user->username.
		    " email: " . $user->email.
		    " pass: " . $user->password.
		    " permission: " . $user->permission;
		    //exit;

		    $user->save();
		    return redirect('users')->with('message', 'success|'.$user->username.' erfolgreich angelegt!');
    	} 
    	else
     	{
        	// validation has failed, display error messages   
        	return redirect('members/adduser/'.$user->member_id)->with('message', 'danger|Die folgenden Fehler sind aufgetreten:')->withErrors($validator)->withInput();
        	//eig. members/register sinniger
    	}
	}

	public function getEdituser ($user_id){
		$user = User::find($user_id);
		$member = Member::find($user->member_id);
		return view('users.edituser')->with('user', $user)->with('member', $member);
	}

}
