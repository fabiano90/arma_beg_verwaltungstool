<?php

namespace App\Http\Controllers;
use Request;
use App\Models\Post;
use App\Models\User;

class PostController extends Controller
{

	public function getIndex()
	{
		$posts = Post::orderBy('updated_at', 'DESC')->get(); // Hier später definieren, welche Posts gelesen werden dürfen
		return view('posts.index')->with('posts', $posts);
	}

	public function getTestdata()
	{
		for ($i = 0; $i < 5; $i++)
		{
			$post = new Post();
			$post->user_id = 1;
			$post->title = md5(time()*rand());
			$post->content = md5(time()*rand());
			$post->link = '';
			$post->save();

		}
		
	}

}
