<?php

namespace App\Http\Controllers;
use Request;
use Auth;
use App\Models\Message;
use App\Models\User;

class MessageController extends Controller
{

	public function getIndex()
	{
		$userLogin = Auth::user();
		$user_id=$userLogin->id;
		$user = User::find($user_id);
		$users= User::all();
		$messages = $user->messages();
		$reversed = array_reverse($messages->toArray());
		return view('messages.index')->with('messages', $reversed)->with('user', $user)->with('users', $users);
	}

	public function getChat($partner_id=0)
	{
		
		$userLogin = Auth::user();
		$user_id=$userLogin->id;
		$users= User::where('id', "!=", $user_id)->orderBy('username')->get();
		$user = User::find($user_id);
		$partner = User::find($partner_id);
		$allmessages=Message::all();
		$messages = $user->chat($partner_id)->reverse();

		foreach ($messages as $massage) {
			if($user_id ==$massage->receiver_id){
				$massage->visited=0;
				$massage->save();
			}
		}
	
		return view('messages.index')->with('allmessages', $allmessages)->with('messages', $messages)->with('user', $user)->with('partner', $partner)->with('users', $users);
	}
public function postNew($partner_id)
    {
		
    	{
    		$userLogin = Auth::user();
			$user_id=$userLogin->id;
        	$post = new Message();
		    $post->sender_id = $user_id;
			$post->receiver_id = $partner_id;
			$post->content = Request::input('content');
			$post->visited=1;
			$post->save();
		    
		 
		   return redirect('messages/chat/'.$partner_id);

    	} 
    	
    }

}
