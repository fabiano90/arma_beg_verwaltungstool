<?php

namespace App\Http\Controllers;

use Request;
use App\Models\Sundayservice;
use App\Models\User;
use App\Models\Kigo;
use App\Models\Sermon;
use App\Models\Member;
use App\Models\Song;
use Illuminate\Database\Eloquent\Model;
use Validator;
use DB;

class SundayserviceController extends Controller {

	
	public function getIndex() {
		$sundayservices = Sundayservice::all();		
		return view ( 'sundayservices.index' )->with ( 'sundayservices', $sundayservices );
	}

	public function getEditservice($sundayId) {
		$sunday=Sundayservice::find($sundayId);
		$songs = Song::all();
		$songsOrder=array(1 => "",2 => "",3 => "",4 => "",5 => "",6 => "");
		foreach ($sunday->songs as $song) {
			$songsOrder[$song->pivot->order] =': '.$song->name;
		}
		return view ( 'sundayservices.editservice' )->with ( 'sunday', $sunday )->with('songs', $songs)->with('songsOrder', $songsOrder);
	}

	public function postEditservice($service_id){
		/*$validator = Validator::make(Request::all(), User::$rules);
		if ($validator->passes()) 
		{*/
	    	// validation has passed, save user in DB
			$service = Sundayservice::find($service_id);
		    $service->psalm = Request::input('psalm');
		    $service->biblereading = Request::input('biblereading');
		    $service->comments = Request::input('comments');
		    $service->sacrament = Request::input('sacrament');
		    $song1 = Request::input('song1');
		    $song2 = Request::input('song2');
		    $song3 = Request::input('song3');
		    $song4 = Request::input('song4');
		    $song5 = Request::input('song5');
		    $song6 = Request::input('song6');

		   
		   
			if($song1){
				$aktSong=0;
				foreach ($service->songs as $song) {
					if($song->pivot->order==1)	
					$aktSong= $song->pivot->song_id;
				}
				$service->songs()->detach($aktSong);
				$service->songs()->attach($song1,['order' => '1','songdate' => $service->sermons->date]);
				

			}

			if($song2){
				$aktSong=0;
				foreach ($service->songs as $song) {
					if($song->pivot->order==2)	
					$aktSong= $song->pivot->song_id;
				}
				$service->songs()->detach($aktSong);
				$service->songs()->attach($song2,['order' => '2','songdate' => $service->sermons->date]);
			}

			if($song3){
				$aktSong=0;
				foreach ($service->songs as $song) {
					if($song->pivot->order==3)	
					$aktSong= $song->pivot->song_id;
				}
				$service->songs()->detach($aktSong);
				$service->songs()->attach($song3,['order' => '3','songdate' => $service->sermons->date]);
			}

			if($song4){
				$aktSong=0;
				foreach ($service->songs as $song) {
					if($song->pivot->order==4)	
					$aktSong= $song->pivot->song_id;
				}
				$service->songs()->detach($aktSong);
				$service->songs()->attach($song4,['order' => '4','songdate' => $service->sermons->date]);
			}

			if($song5){
				$aktSong=0;
				foreach ($service->songs as $song) {
					if($song->pivot->order==5)	
					$aktSong= $song->pivot->song_id;
				}
				$service->songs()->detach($aktSong);				
				$service->songs()->attach($song5,['order' => '5','songdate' => $service->sermons->date]);
			}


			if($song6){
				
				$aktSong=0;
				foreach ($service->songs as $song) {
					if($song->pivot->order==6)	
					$aktSong= $song->pivot->song_id;
				}
				$service->songs()->detach($aktSong);
				$service->songs()->attach($song6,['order' => '6','songdate' => $service->sermons->date]);
			}
		


			$service->save();
		    return redirect('sundayservices')->with('message', 'success|Student erfolgreich angelegt!');
		/*} 
		else
	 	{
	    	// validation has failed, display error messages   
	    	return redirect('members/register')->with('message', 'danger|Die folgenden Fehler sind aufgetreten:')->withErrors($validator)->withInput();
		}*/
	}

	public function getAddsong($service_id)
	{
		$sunday = Sundayservice::find($service_id);
		$songs = Song::all();
		return view('sundayservices.addsongtosunday')->with('songs', $songs)->with('sunday', $sunday);
	}

	public function postAddsongtosunday($service_id)
	{
		$service = Sundayservice::find($service_id);

		$songs = Song::all();
		foreach ($songs as $song) {
			//echo 'song id:' . $song->id;
			//echo ' input req: ' . Request::input('id'.$song->id). '<br/>';
			$service->songs()->attach(Request::input('id'.$song->id));
		}
		$service->save();
		return redirect('sundayservices')->with('message', 'success|Gottesdienst erfolgreich bearbeitet!');		
	}	

	


}
