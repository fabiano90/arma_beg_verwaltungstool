<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Member;
use App\Models\Message;
use App\Models\Song;
use App\Models\Kigo;
use App\Models\Sundayservice;
use App\Models\Sermon;
use Validator;
use View;
use Request;
use Hash;
use Auth;
use DB;

class SongController extends Controller
{
	public function getIndex()
	{	
		//$songs = Sundayservice::has('songs')->has('sermons')->orderBy('date', 'DESC')->get();
		$songs = Song::all();
		return view('songs.index')->with('songs', $songs);//->with('song_dates', $song_dates)->with('song_count', $song_count);
	}

	public function getAddsong()
	{
		$songs = Song::all();
		return view('songs.addsong')->with('songs', $songs);
	}

	public function postAddsong(){
		$validator = Validator::make(Request::all(), Song::$rules);
		if ($validator->passes()) 
		{
	    	// validation has passed, save user in DB
			$song = new Song;
			$song->number = Request::input('number');
		    $song->name = Request::input('name');
		    $song->annotation = Request::input('annotation');
			$song->save();
		    return redirect('songs')->with('message', 'success|Lied erfolgreich angelegt!');
		} 
		else
	 	{
	    	// validation has failed, display error messages   
	    	return redirect('songs/addsong')->with('message', 'danger|Die folgenden Fehler sind aufgetreten:')->withErrors($validator)->withInput();
		}
	}

	public function getEditsong($song_id){
		$song = Song::find($song_id);
		return view('songs.editsong')->with('song', $song);
	}

	public function postEditsong($song_id){
		$validator = Validator::make(Request::all(), Song::$rules);
		if ($validator->passes()) 
		{
	    	// validation has passed, save user in DB
			$song = Song::find($song_id);
			$song->number = Request::input('number');
		    $song->name = Request::input('name');
		    $song->annotation = Request::input('annotation');
			$song->save();
		    return redirect('songs')->with('message', 'success|Lied erfolgreich bearbeitet!');
		} 
		else
	 	{
	    	// validation has failed, display error messages   
	    	return redirect('songs/editsong/'.$song_id)->with('message', 'danger|Die folgenden Fehler sind aufgetreten:')->withErrors($validator)->withInput();
		}
	}

    public function getDeletesong($id)
    {
        $song = Song::find($id);
       	//$song->deleteCascade();
        $song->delete();
        return redirect('songs/index')->with('message', 'success|Student wurde erfolgreich gelöscht!');
    }    
}
