<?php

namespace App\Http\Controllers;

use Request;
use App\Models\Sundayservice;
use App\Models\User;
use App\Models\Kigo;
use App\Models\Sermon;
use App\Models\Member;
use App\Models\Song;
use App\Models\Message;
use Illuminate\Database\Eloquent\Model;
use Auth;
use Validator;
use DB;

class SundayController extends Controller {

	public function getIndex($filter=1) {
		$user=Auth::user();
		if($filter==1){
			$datetime=time();
			
		}else{
			$datetime=$filter;
		}
		
		
		$sundayservices=Sundayservice::whereHas('sermons', function($q) use ($datetime)
				{
				    $q->where('date','>=',$datetime);
				   

				})->get();
			
		
		
			
		return view ( 'sundays.index' )->with ( 'sundayservices', $sundayservices )->with ( 'user', $user )->with ( 'filter', $filter );
	}

	
	public function getEditsunday($sundayId) {
		$sunday=Sundayservice::find($sundayId);

		$kigos_list = $this->getKigoslist();
		$preachers_list = $this->getPreacherslist();
		$lectors_list = $this->getLectorslist();
		
		$kigo = $sunday->kigos;
		return view ( 'sundays.editsunday' )->with ( 'sunday', $sunday )->with ( 'kigos_list', $kigos_list )->with ( 'preachers_list', $preachers_list )->with ( 'lectors_list', $lectors_list )->with('kigo', $kigo);
	}

	public function postEditsunday($actualSunday) {
		$sundayservice = Sundayservice::find($actualSunday);
		$kigo = Kigo::find($sundayservice->kigo_id);
		$sermon = Sermon::find($sundayservice->sermon_id);
		$validator = Validator::make ( Request::all (), Sundayservice::$rulesedit );
		if ($validator->passes ()) {
			/**
			 *** Benachrichtigunen ***
			 */
			$old_kleader=User::find($kigo->user_id);
			$new_kleader=User::find(Request::input ( 'kigos_list' ));
			if($old_kleader->id!=$new_kleader->id){

				$this->sendMessage($old_kleader,$new_kleader,$sermon->date,'Kigo');

			}

			
			$old_lleader=User::find($sundayservice->user_id);
			$new_lleader=User::find(Request::input ( 'lectors_list' ));
			

			if($old_lleader->id!=$new_lleader->id){
				$this->sendMessage($old_lleader,$new_lleader,$sermon->date,'Leitungs');
				
			}

			$old_sleader=Member::find($sermon->preacher_id);
			$new_sleader=Member::find(Request::input ( 'preachers_list'));
			if($old_sleader->id!=$new_sleader->id){
				$post = new Message();
		    	$post->sender_id = 0;
				$post->receiver_id = $old_sleader->id;
				$post->content = date('d.m.Y',$sermon->date).'<h4>Kein Predigt Dienst</h4>'.$new_sleader->onlinename.' hat für dich übernommen.';
				$post->visited=1;
				$post->save();

				$post = new Message();
		    	$post->sender_id = $new_sleader->id;
				$post->receiver_id = 0;
				$post->content = date('d.m.Y',$sermon->date).'<h4>Neuer Predigt Dienst</h4>'.$old_sleader->onlinename.' hat mit dir getauscht..';
				$post->visited=1;
				$post->save();
				
			}
			/**
			 *** Kigo id suchen und speichern ***
			 */
			$kigoleader_id = Request::input ( 'kigos_list' );
			$kigo->user_id = $kigoleader_id;
			$kigo->lection = Request::input ( 'lection' );
			$kigo->lection_number = Request::input ( 'lection_number' );
			
			
			$kigo->save ();
			echo $kigo->users->username;
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


			
			return redirect ( 'sundays/index' )->with ( 'message', 'success|Sonntag erfolgreich angelegt!' );
		} else {
			// validation has failed, display error messages
			return redirect ( 'sundays/editsunday/'.$actualSunday )->with ( 'message', 'danger|Die folgenden Fehler sind aufgetreten:' )->withErrors ( $validator )->withInput ();
		}
	}

	public function getNewsunday() {
		$kigos_list = $this->getKigoslist();
		$preachers_list = $this->getPreacherslist();
		$lectors_list = $this->getLectorslist();
		
		return view ( 'sundays.newsunday' )->with ( 'kigos_list', $kigos_list )->with ( 'preachers_list', $preachers_list )->with ( 'lectors_list', $lectors_list );
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
			$sermon->date = strtotime(Request::input ( 'date' ));
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
			
			return redirect ( 'sundays/index' )->with ( 'message', 'success|Sonntag erfolgreich angelegt!' );
		} else {
			// validation has failed, display error messages
			return redirect ( 'sundays/newsunday' )->with ( 'message', 'danger|Die folgenden Fehler sind aufgetreten:' )->withErrors ( $validator )->withInput ();
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
		return view ( 'sundays.editYear' )->with ( 'sundays', $sundays )->with ( 'kigos_list', $kigos_list )->with ( 'preachers_list', $preachers_list )->with ( 'lectors_list', $lectors_list )->with ( 'year', $year );
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
			return redirect ( 'sundays/index' )->with ( 'message', 'success|Jahr erfolgreich angelegt!' );
		} else {
			// validation has failed, display error messages
			return redirect ( 'sundays.edityear/2015' )->with ( 'message', 'danger|Die folgenden Fehler sind aufgetreten:' )->withErrors ( $validator )->withInput ();
		}
	}

	public function getNewyear($year) {
		$sundays = $this->sundaysYear ( $year );
		$kigos_list =$this-> getKigoslist();
		$preachers_list =$this-> getPreacherslist();
		$lectors_list = $this->getLectorslist();
		return view ( 'sundays.newYear' )->with ( 'sundays', $sundays )->with ( 'kigos_list', $kigos_list )->with ( 'preachers_list', $preachers_list )->with ( 'lectors_list', $lectors_list )->with ( 'year', $year );
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
			return redirect ( 'sundays/index' )->with ( 'message', 'success|Jahr erfolgreich angelegt!' );
		} else {
			// validation has failed, display error messages
			return redirect ( 'sundays/newyear/' . $year )->with ( 'message', 'danger|Die folgenden Fehler sind aufgetreten:' )->withErrors ( $validator )->withInput ();
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

	public function getDeletesunday($sundays_id){
		$sunday = Sundayservice::find($sundays_id);
		$sunday->songs()->detach();
		$kigo = $sunday->kigos;
		$kigo->songs()->detach();
		$kigo->delete();
		Sermon::destroy($sunday->sermon_id);
		$sunday->delete();
		return redirect('sundays')->with('message', 'success|Gottesdienst wurde erfolgreich gelöscht!');
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

	public function sendMessage($old,$new,$date,$task){

				$post = new Message();
		    	$post->sender_id = 0;
				$post->receiver_id = $old->id;
				$post->content = date('d.m.Y',$date).'<h4>Kein '.$task.' Dienst</h4>'.$new->username.' hat für dich übernommen.';
				$post->visited=1;
				$post->save();

				$post = new Message();
		    	$post->sender_id = $new->id;
				$post->receiver_id = 0;
				$post->content = date('d.m.Y',$date).'<h4>Neuer '.$task.'Dienst</h4>'.$old->username.' hat mit dir getauscht.';
				$post->visited=1;
				$post->save();

			
	}

}
