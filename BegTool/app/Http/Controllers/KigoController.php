<?php

namespace App\Http\Controllers;

use Request;
use App\Models\Sundayservice;
use App\Models\User;
use App\Models\Kigo;
use App\Models\Sermon;
use Illuminate\Database\Eloquent\Model;
use DB;

class KigoController extends Controller {

	public function getIndex() {
		/*$kigoAndLeader = DB::table('kigos')
			->join('users', 'kigos.user_id', '=','users.id')
			->join('sundayservices', 'kigos.id', '=', 'sundayservices.kigo_id')
			->join('sermons', 'sundayservices.sermon_id', '=', 'sermons.id')
			->join('kigo_song', 'kigos.id', '=', 'kigo_song.kigo_id')
			->join('songs', 'kigo_song.song_id', '=', 'songs.id')
			->select('sermons.date', 'kigos.id', 'users.username', 'lection_number', 'lection', 'conclusion', 'material', 'crafting', 'songs.name')
			->get();

		$kigoAndLeader2 = DB::table('kigos')
			->join('users', 'kigos.user_id', '=','users.id')
			->join('sundayservices', 'kigos.id', '=', 'sundayservices.kigo_id')
			->join('sermons', 'sundayservices.sermon_id', '=', 'sermons.id')
			->join('kigo_song', 'kigos.id', '=', 'asdffgfghhjjhahsbbstgbsrtdhfadysnd')
			->join('songs', 'kigo_song.song_id', '=', 'songs.id')
			->select('sermons.date', 'kigos.id', 'users.username', 'lection_number', 'lection', 'conclusion', 'material', 'crafting', 'songs.name')
			->get();	
		*/	

		//print_r($kigoAndLeader);
		//echo '<br/><br/>'.var_dump($kigoAndLeader);exit;	
		//$merged = $kigoAndLeader->push($kigoAndLeader2);
		//$merged = $kigoAndLeader + $kigoAndLeader2;

		//	$array2 = array("name" => "jo");
		//	$temp = array_merge($kigoAndLeader2, $array2);
		//$merged = array_combine ($kigoAndLeader, $kigoAndLeader2);

		//$kigos = Kigo::paginate(10);




		$kigos = Kigo::all();
		//echo $kigo->users->username;
		foreach ($kigos as $kigo) {
			echo $kigo->sundayservices->sermons->date;
			echo $kigo->sundayservices->users->username;
			echo $kigo->users->username;			
			foreach ($kigo->songs as $song) {
			    echo $song->name;
			}
			echo '<br/>';
		}
		exit;


		return view ('kigos.index')->with('kigos', $kigoAndLeader);//->with('kigo_leader', $kigoAndLeader);
	}

	public function getEditkigo($kigo_id){
		$kigo = Kigo::find($kigo_id);
		return view('kigos.editkigo')->with('kigo', $kigo);
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
		    return redirect('kigos')->with('message', 'success|Student erfolgreich angelegt!');
		/*} 
		else
	 	{
	    	// validation has failed, display error messages   
	    	return redirect('members/register')->with('message', 'danger|Die folgenden Fehler sind aufgetreten:')->withErrors($validator)->withInput();
		}*/
	}


	
}
