<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Message;
use Validator;
use View;
use Request;
use Hash;
use Auth;

class LoginController extends Controller
{
	public function __construct(){
		$this->beforeFilter('auth', array('only' => array('getDashboard')));
	}

	public function getLogin()
	{	
		echo Hash::make('abc');
		//echo Hash::make('123456');
		return view('login.login');
	}


	public function postLogin(){
		$username = Request::input('username');
		$password = Request::input('password');
		echo $username;
		echo $password;
		//exit;
		if(Auth::attempt(
			array(
				'username'=>$username,
				'password'=>$password
				)
			))	
		{
			//login ok
			$user = Auth::user();
			return redirect('users/timeline/'. $user->id);
		}
		else{
			//login nicht ok
			return redirect('login/login');
		}
	}

	public function getLogout($user_id = 0){
		Auth::logout();
	}

	public function getToken()
	{
		$response = new \stdClass;
		$response->token = csrf_token();
		$response->success = true;
		return response()->json($response);
	}
}
