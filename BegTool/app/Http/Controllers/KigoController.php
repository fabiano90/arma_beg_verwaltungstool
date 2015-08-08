<?php

namespace App\Http\Controllers;

use Request;
use App\Models\Sundayservice;
use App\Models\User;
use App\Models\Kigo;
use App\Models\Sermon;
use App\Models\Song;
use Illuminate\Database\Eloquent\Model;
use DB;

class KigoController extends Controller {

	public function getIndex() {
		$kigos = Kigo::all();
		return view ('kigos.index')->with('kigos', $kigos);//->with('kigo_leader', $kigoAndLeader);
	}

	public function getEditkigo($kigo_id){
		$kigo = Kigo::find($kigo_id);
		return view('kigos.editkigo')->with('kigo', $kigo);//->with('kigo_songs', $kigo_songs);
	}

	public function postEditkigo($kigo_id){
		/*$validator = Validator::make(Request::all(), User::$rules);
		if ($validator->passes()) 
		{*/
	    	// validation has passed, save user in DB
			$kigo = Kigo::find($kigo_id);
		    $kigo->lection_number = Request::input('lection_number');
		    $kigo->lection = Request::input('lection');
		    $kigo->conclusion = Request::input('conclusion');
		    $kigo->material = Request::input('material');
		    $kigo->crafting = Request::input('crafting');
			$kigo->save();
		    return redirect('kigos/addsong/'.$kigo_id)->with('message', 'success|Student erfolgreich angelegt!');
		/*} 
		else
	 	{
	    	// validation has failed, display error messages   
	    	return redirect('members/register')->with('message', 'danger|Die folgenden Fehler sind aufgetreten:')->withErrors($validator)->withInput();
		}*/
	}

	public function getAddsong($kigo_id)
	{
		$kigo = Kigo::find($kigo_id);
		$songs = Song::all();
		$kigo_songs = $kigo->songs;
		return view('kigos.addsongtokigo')->with('songs', $songs)->with('kigo', $kigo)->with('kigo_songs', $kigo_songs);
	}

	public function postAddsongtokigo($kigo_id)
	{
		$kigo = Kigo::find($kigo_id);

		$songs = Song::all();
		foreach ($songs as $song) {
			//echo 'song id:' . $song->id;
			//echo ' input req: ' . Request::input('id'.$song->id). '<br/>';
			$kigo->songs()->attach(Request::input('id'.$song->id));
		}
		$kigo->save();
		return redirect('kigos')->with('message', 'success|Kigo erfolgreich bearbeitet!');		
	}	
}
