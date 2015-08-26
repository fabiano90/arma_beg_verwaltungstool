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

	public function getKalender() {
		$sundayservices=Sundayservice::all();
// 		$thisyearangelegt=0;
// 		foreach ($sundayservices as $sundayservice) {
// 			if(date('Y',$sundayservice->sermon->date) = date(date('y'))
// 				$thisyearangelegt++;
// 		}
			
		return view ( 'sundayservices.kalender' )->with ( 'sundayservices', $sundayservices );
	}

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
				$service->songs()->attach($song2,['order' => '2']);
			}

			if($song3){
				$aktSong=0;
				foreach ($service->songs as $song) {
					if($song->pivot->order==3)	
					$aktSong= $song->pivot->song_id;
				}
				$service->songs()->detach($aktSong);
				$service->songs()->attach($song3,['order' => '3']);
			}

			if($song4){
				$aktSong=0;
				foreach ($service->songs as $song) {
					if($song->pivot->order==4)	
					$aktSong= $song->pivot->song_id;
				}
				$service->songs()->detach($aktSong);
				$service->songs()->attach($song4,['order' => '4']);
			}

			if($song5){
				$aktSong=0;
				foreach ($service->songs as $song) {
					if($song->pivot->order==5)	
					$aktSong= $song->pivot->song_id;
				}
				$service->songs()->detach($aktSong);				
				$service->songs()->attach($song5,['order' => '5']);
			}


			if($song6){
				
				$aktSong=0;
				foreach ($service->songs as $song) {
					if($song->pivot->order==6)	
					$aktSong= $song->pivot->song_id;
				}
				$service->songs()->detach($aktSong);
				$service->songs()->attach($song6,['order' => '6']);
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

	public function getEditsunday($sundayId) {
		$sunday=Sundayservice::find($sundayId);

		$kigos_list = $this->getKigoslist();
		$preachers_list = $this->getPreacherslist();
		$lectors_list = $this->getLectorslist();
		
		return view ( 'sundayservices.editsunday' )->with ( 'sunday', $sunday )->with ( 'kigos_list', $kigos_list )->with ( 'preachers_list', $preachers_list )->with ( 'lectors_list', $lectors_list );
	}

	public function postEditsunday($actualSunday) {
		$sundayservice = Sundayservice::find($actualSunday);
		$kigo = Kigo::find($sundayservice->kigo_id);
		$sermon = Sermon::find($sundayservice->sermon_id);
		$validator = Validator::make ( Request::all (), Sundayservice::$rulesedit );
		if ($validator->passes ()) {
			/**
			 * ** Kigo id suchen und speichern ***
			 */
			$kigoleader_id = Request::input ( 'kigos_list' );
			$kigo->user_id = $kigoleader_id;
			$kigo->lection = Request::input ( 'lection' );
			$kigo->lection_number = Request::input ( 'lection_number' );
			$kigo->save ();
			
			/**
			 * ** Preacher id + date suchen und speichern ***
			 */
			$sermon->preacher_id = Request::input ( 'preachers_list' );
			$sermon->save ();
			
			/**
			 * ** Preacher id suchen***
			 */
			$lector_id = Request::input ( 'lectors_list' );
			$sundayservice->user_id = $lector_id;
			
			/**
			 * ** Kigo und Sermon id suchen und Speichern***
			 */
			$kigo_id = Kigo::orderBy ( 'created_at', 'DESC' )->first ();
			$sermon_id = Sermon::orderBy ( 'created_at', 'DESC' )->first ();
			$sundayservice->user_id = $lector_id;
			$sundayservice->save ();
			
			return redirect ( 'sundayservices/kalender' )->with ( 'message', 'success|Sonntag erfolgreich angelegt!' );
		} else {
			// validation has failed, display error messages
			return redirect ( 'sundayservices.editsunday/'.$actualSunday )->with ( 'message', 'danger|Die folgenden Fehler sind aufgetreten:' )->withErrors ( $validator )->withInput ();
		}
	}

	public function getNewsunday() {
		$kigos_list = $this->getKigoslist();
		$preachers_list = $this->getPreacherslist();
		$lectors_list = $this->getLectorslist();
		
		return view ( 'sundayservices.newsunday' )->with ( 'kigos_list', $kigos_list )->with ( 'preachers_list', $preachers_list )->with ( 'lectors_list', $lectors_list );
	}

	public function postNewsunday() {
		$sundayservice = new Sundayservice ();
		$kigo = new Kigo ();
		$sermon = new Sermon ();
		$validator = Validator::make ( Request::all (), Sundayservice::$rules );
		if ($validator->passes ()) {
			/**
			 * ** Kigo id suchen und speichern ***
			 */
			$kigoleader_id = Request::input ( 'kigos_list' );
			$kigo->user_id = $kigoleader_id;
			$kigo->lection = Request::input ( 'lection' );
			$kigo->lection_number = Request::input ( 'lection_number' );
			$kigo->save ();
			
			/**
			 * ** Preacher id + date suchen und speichern ***
			 */
			$sermon->preacher_id = Request::input ( 'preachers_list' );
			$sermon->date = Request::input ( 'date' );
			$sermon->save ();
			
			/**
			 * ** Preacher id suchen***
			 */
			$lector_id = Request::input ( 'lectors_list' );
			$sundayservice->user_id = $lector_id;
			
			/**
			 * ** Kigo und Sermon id suchen und Speichern***
			 */
			$kigo_id = Kigo::orderBy ( 'created_at', 'DESC' )->first ();
			$sermon_id = Sermon::orderBy ( 'created_at', 'DESC' )->first ();
			$sundayservice->user_id = $lector_id;
			$sundayservice->kigo_id = $kigo_id->id;
			$sundayservice->sermon_id = $sermon_id->id;
			$sundayservice->save ();
			
			return redirect ( 'sundayservices/kalender' )->with ( 'message', 'success|Sonntag erfolgreich angelegt!' );
		} else {
			// validation has failed, display error messages
			return redirect ( 'sundayservices.newsunday' )->with ( 'message', 'danger|Die folgenden Fehler sind aufgetreten:' )->withErrors ( $validator )->withInput ();
		}
	}

	public function getEdityear($year) {
		
		 $lastyear = $year-"1 year";
		 $lastyear = strtotime("31.12.".$lastyear);
		 $nextyear = $year+"1 year";
		 $nextyear = strtotime("01.01.".$nextyear);

		$sundays=Sermon::where('date', '<', $nextyear )->where('date', '>', $lastyear )->get();
		$kigos_list =$this-> getKigoslist();
		$preachers_list =$this-> getPreacherslist();
		$lectors_list = $this->getLectorslist();
		return view ( 'sundayservices.editYear' )->with ( 'sundays', $sundays )->with ( 'kigos_list', $kigos_list )->with ( 'preachers_list', $preachers_list )->with ( 'lectors_list', $lectors_list )->with ( 'year', $year );
	}

	public function postEdityear() {
		
			
		$validator = Validator::make ( Request::all (), Sundayservice::$rulesedit );
		if ($validator->passes ()) {

			
			
			$sundays=Sundayservice::all();
			foreach ($sundays as $sunday) {
			
				$sundayservice = Sundayservice::find($sunday->id);
				$kigo = Kigo::find($sunday->kigo_id);
				$sermon = Sermon::find($sunday->sermon_id);
						
				/**
				 * ** Kigo suchen und speichern ***
				 */
				$kigo->user_id = Request::input ( 'kigos_list' . $sunday->id );
				$kigo->lection = Request::input ( 'lection' . $sunday->id);
				$kigo->lection_number = Request::input ( 'lection_number' . $sunday->id );
				$kigo->save ();
				/**
				 * ** Preacher id + date suchen und speichern ***
				 */
				$sermon->preacher_id = Request::input ( 'preachers_list' . $sunday->id );
				$sermon->save ();
				
				
				/**
				 * ** Lector id suchen***
				 */
				$sundayservice->user_id = Request::input ( 'lectors_list' . $sunday->id );
				$sundayservice->save ();
				 
				
			}
			return redirect ( 'sundayservices.kalender' )->with ( 'message', 'success|Jahr erfolgreich angelegt!' );
		} else {
			// validation has failed, display error messages
			return redirect ( 'sundayservices.edityear/2015' )->with ( 'message', 'danger|Die folgenden Fehler sind aufgetreten:' )->withErrors ( $validator )->withInput ();
		}
	}

	public function getNewyear($year) {
		$sundays = $this->sundaysYear ( $year );
		$kigos_list =$this-> getKigoslist();
		$preachers_list =$this-> getPreacherslist();
		$lectors_list = $this->getLectorslist();
		return view ( 'sundayservices.newYear' )->with ( 'sundays', $sundays )->with ( 'kigos_list', $kigos_list )->with ( 'preachers_list', $preachers_list )->with ( 'lectors_list', $lectors_list )->with ( 'year', $year );
	}

	public function postNewyear() {
		$year = Request::input ( 'year' );
		$sundays = $this->sundaysYear ( $year );
		
		$validator = Validator::make ( Request::all (), Sundayservice::$rulesedit );
		if ($validator->passes ()) {
			
			for($i = 0; $i < 52; $i ++) {
				
				$sundayservice = new Sundayservice ();
				$kigo = new Kigo ();
				$sermon = new Sermon ();
				
				/**
				 * ** Kigo suchen und speichern ***
				 */
				$kigoleader_id = Request::input ( 'kigos_list' . $sundays [$i] );
				$kigo->user_id = $kigoleader_id;
				$kigo->lection = Request::input ( 'lection' . $sundays [$i] );
				$kigo->lection_number = Request::input ( 'lection_number' . $sundays [$i] );
				
				/**
				 * ** Preacher id + date suchen und speichern ***
				 */
				$preacher_id = Request::input ( 'preachers_list' . $sundays [$i] );
				$sermon->preacher_id = $preacher_id;
				$date = Request::input ( 'date' . $sundays [$i] );
				$sermon->date=strtotime($date);
				echo $sermon->date;
				/**
				 * ** Lector id suchen***
				 */
				$lector_id = Request::input ( 'lectors_list' . $sundays [$i] );
				$sundayservice->user_id = $lector_id;
				
				$sermon->save ();
				$kigo->save ();
				/**
				 * ** Kigo und Sermon id suchen und Speichern***
				 */
				$kigo_id = Kigo::orderBy ( 'id', 'DESC' )->first ();
				$sermon_id = Sermon::orderBy ( 'id', 'DESC' )->first ();
				$sundayservice->user_id = $lector_id;
				$sundayservice->kigo_id = $kigo_id->id;
				$sundayservice->sermon_id = $sermon_id->id;
				$sundayservice->save ();
			}
			return redirect ( 'sundayservices/kalender' )->with ( 'message', 'success|Jahr erfolgreich angelegt!' );
		} else {
			// validation has failed, display error messages
			return redirect ( 'sundayservices/newyear/' . $year )->with ( 'message', 'danger|Die folgenden Fehler sind aufgetreten:' )->withErrors ( $validator )->withInput ();
		}
	}

	public function sundaysYear($year) {
		$startDate = strtotime ( $year . '-01-01 23:59:59' );
		$sundays [] = null;
		$ids [] = null;
		$nextYear = $year + 1;
		
		for($i = 0; strcmp ( date ( 'd.m.Y', $startDate ), '01.01.' . $nextYear ) != 0;) {
			
			if (strcmp ( date ( 'D', $startDate ), 'Sun' ) == 0) {
				$sundays [$i] = $startDate;
				$i ++;
			}
			$startDate = strtotime ( '+1 day', $startDate );
		}
		return $sundays;
	}

	public function getKigoslist(){
		return User::all()->lists ( 'username', 'id' );
	}

	public function getLectorslist(){
		return User::where ( 'permission', '<=', 1 )->lists ( 'username', 'id' );
	}

	public function getPreacherslist(){
		return Member::all()->lists ( 'onlinename', 'id' );
	}
}
