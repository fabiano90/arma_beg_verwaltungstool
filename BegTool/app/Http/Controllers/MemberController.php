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




	public function getShow()
	{
		$persons = Person::all();
		echo count($persons);
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
