<?php

namespace App\Http\Controllers;
use Request;
use App\Models\Message;
use App\Models\User;

class MessageController extends Controller
{

	public function getIndex($user_id)
	{
		$user = User::find($user_id);
		$messages = $user->messages();
		return view('messages.index')->with('messages', $messages)->with('user', $user);
	}

	public function getChat($partner_id)
	{
		// 1 ID des eingeloggten User
		$user = User::find(1);
		$messages = $user->chat($partner_id);
		return view('messages.index')->with('messages', $messages)->with('user', $user);
	}

	public function postIndex(){

			$message = new Message();
			$message->sender_id = 1;// Request::input('firstname');
			$message->receiver_id = 3;
			$message->content = Request::input('content');
			$message->save();

		//if succcess
			//return redirect('messages')->with('messages', 'success|Student erfolgreich angelegt!');
		//else
	}

	public function getTestdata()
	{
		for ($i = 0; $i < 5; $i++)
		{
			$post = new Message();
			$post->sender_id = 1;
			$post->receiver_id = 2;
			$post->content = '1 - 2: '.md5(time()*rand());
			$post->save();

			$post = new Message();
			$post->sender_id = 2;
			$post->receiver_id = 1;
			$post->content = '2 - 1: '.md5(time()*rand());
			$post->save();

			$post = new Message();
			$post->sender_id = 1;
			$post->receiver_id = 3;
			$post->content = '1 - 3: '.md5(time()*rand());
			$post->save();

			$post = new Message();
			$post->sender_id = 3;
			$post->receiver_id = 1;
			$post->content = '3 - 1: '.md5(time()*rand());
			$post->save();

		}
		
	}
}
