<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Person;
use App\Models\Message;
use App\Models\Member;
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
		$users = User::paginate(15);		
		return view('users.index')->with('users', $users);//->with('jaja', $jaja);
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







	public function getShow()
	{
		$users = User::all();
		echo count($users);
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

	public function getSearch(){
		$user = Auth::user();
	}

	public function getFriends($friend_id = 0){
		$user = Auth::user();
		$friends = $user->friends;
		//return view('users.friends')->with('friends', $friends);

		$alreadyfriend = -1;
		$error = -1;

		return view('users.friends')
			->with('friends', $friends)
			->with('error', $error)
			->with('alreadyfriend', $alreadyfriend);
	}

	public function getAddfriend($friend_id = 0){
		$user = Auth::user();
		$alreadyfriend = -1;
		$error = -1;
		if($user->id == $friend_id){
			//echo 'Du kannst nicht mit dir selbst befreundet sein!';
			$error = 0;//freund mit sich selbst
		}
		else{
			if($user->friends->contains($friend_id)){
				//echo '<script>alert(\'swag\');</script>';
				$error = 1;//bereits befreundet
				$alreadyfriend = $user->friends->find($friend_id);
			}
			else{			
				$user->friends()->attach($friend_id);					
			}
			
			//return view('users.friends')->with('error', $error);
		}		
		return redirect('users/friends')->with('error', $error);
			//$user = Auth::user();
			//$friends = $user->friends;
			//return view('users.friends')->with('friends', $friends)->with('error', $error)->with('alreadyfriend', $alreadyfriend);
	}

	public function getRemovefriend($friend_id = 0){
		$user = Auth::user();			
		$user->friends()->detach($friend_id);
		$friends = $user->friends;		
		//return redirect('users/friends');
		$alreadyfriend = -1;
		$error = -1;

		return view('users.friends')
			->with('friends', $friends)
			->with('error', $error)
			->with('alreadyfriend', $alreadyfriend);
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
