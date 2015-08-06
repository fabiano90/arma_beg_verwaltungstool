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
		$messages = $user->messages();
		$reversed = array_reverse($messages->toArray());
		return view('messages.index')->with('messages', $reversed)->with('user', $user);
	}

	public function getChat($partner_id)
	{
	
		$userLogin = Auth::user();
		$user_id=$userLogin->id;
		$user = User::find($user_id);
		$partner = User::find($partner_id);
		$messages = $user->chat($partner_id)->reverse();
	
		return view('messages.index')->with('messages', $messages)->with('user', $user)->with('partner', $partner);
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
			$post->save();
		    
		 
		   return redirect('messages/chat/'.$partner_id);

    	} 
    	
    }

}
