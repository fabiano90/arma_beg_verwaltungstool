<?php

namespace App\Http\Controllers;

use Request;
use App\Models\Sundayservice;
use App\Models\Sermon;
use App\Models\Song;
use Illuminate\Database\Eloquent\Model;

class SermonController extends Controller {

	public function getIndex() {
		$sermons = Sermon::all();
		return view ('sermons.index')->with('sermons', $sermons);//->with('kigo_leader', $kigoAndLeader);
	}

	public function getEditsermon($sermon_id){
		$sermon = Sermon::find($sermon_id);
		return view('sermons.editsermon')->with('sermon', $sermon);//->with('kigo_songs', $kigo_songs);
	}

	public function postEditsermon($sermon_id){
		/*$validator = Validator::make(Request::all(), User::$rules);
		if ($validator->passes()) 
		{*/
	    	// validation has passed, save user in DB
			$sermon = Sermon::find($sermon_id);
			$sermon->scripture = Request::input('scripture');
			$sermon->topic = Request::input('topic');
			$sermon->subitem = Request::input('subitem');
			$sermon->series = Request::input('series');
			$sermon->book = Request::input('book');
			$sermon->occasion = Request::input('occasion');
			$sermon->info_text = Request::input('info_text');
			$sermon->link = Request::input('link');
			$sermon->save();
		    return redirect('sermons')->with('message', 'success|Predigt erfolgreich angelegt!');
		/*} 
		else
	 	{
	    	// validation has failed, display error messages   
	    	return redirect('members/register')->with('message', 'danger|Die folgenden Fehler sind aufgetreten:')->withErrors($validator)->withInput();
		}*/
	}
}
