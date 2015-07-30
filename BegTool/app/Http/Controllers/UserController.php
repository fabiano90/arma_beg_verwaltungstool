<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Message;
use Validator;
use View;
use Request;
use Hash;
use Auth;
class UserController extends Controller
{

	public function getIndex()
	{
		$users = User::paginate(15);
		return view('users.index')->with('users', $users);
	}

	public function getShow()
	{
		$users = User::all();
		return view('users.newfriend')->with('users', $users);
	}

	public function getTimeline($user_id = 0)
	{

		//$user = User::find($user_id);
		if($user_id == 0){
			$user = User::find(Auth::user()->id);
		}
		else{
			$user = User::find($user_id);
		}
		//return redirect('users/timeline/'. $user->id);
		$posts = $user->posts()->orderBy('updated_at', 'DESC')->get();
		//$posts = Post::where('user_id', '=', $user_id)->get();//ganz alt
		return view('users.timeline')->with('posts', $posts)->with('user', $user);
	}

	public function getRegister(){
		$user = new User();
		return view('users.register')->with('user', $user);
	}

	public function postRegister(){
		/*$validator = Validator::make(Request::all(), User::$rules);
 
    	if ($validator->passes()) 
    	{*/
        	// validation has passed, save user in DB
    		$user = new User;
    		$user->firstname = Request::input('firstname');
    		$user->lastname = Request::input('lastname');
    		$user->username = Request::input('username');
    		$user->email = Request::input('email');
		    //$user->birthdate = Request::input('birthdate');
    		$user->password = Hash::make(Request::input('password'));
    		$user->save();

    		return redirect('users')->with('message', 'success|Student erfolgreich angelegt!');
    	/*} 
    	else 
    	{
        	// validation has failed, display error messages   
        	return redirect('users/new')->with('message', 'danger|Die folgenden Fehler sind aufgetreten:')->withErrors($validator)->withInput();
        }*/
    }
    public function getFriends(){


    
    	$user = Auth::user();
    	$friends=$user->friends;
    	return view('users.friends')->with('friends',$friends);

    }
    public function getAddfriend($friend_id =0){
    	$user = Auth::user();
    	if($user->id==$friend_id||$user->friends->contains($friend_id)){
    		return redirect('users/friends')->with('message', 'danger|Fehler!');
    	}
    	else{
    	$user->friends()->attach($friend_id);
    	 return redirect('users/friends');
    	}




    }
    public function getRemovefriend($friend_id =0){


    	
    	$user = Auth::user();
    	$user->friends()->detach($friend_id);
    	return redirect('users/friends');
// Hiermit wird in die Tabelle friend_user für den aktuellen User eine Zeile mit friend_id = 4 erzeugt


    }

	/*public function postIndex(){

			$message = new Message();
			$message->sender_id = 1;// Request::input('firstname');
			$message->receiver_id = 1;
			$message->content = Request::input('content');
			$message->save();

		//if succcess
			return redirect('users')->with('message', 'success|Student erfolgreich angelegt!');
		//else
		}*/
	}
