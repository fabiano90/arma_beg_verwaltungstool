<?php

namespace App\Http\Controllers;

use Request;
use App\Models\Sundayservice;
use App\Models\User;
use App\Models\Kigo;
use App\Models\Sermon;
use Illuminate\Database\Eloquent\Model;
use Validator;
use DB;

class SundayserviceController extends Controller {
	public function getIndex() {
		$kalender2s = DB::table ( 'sundayservices' )
			->select ( 'sermons.date', 'kigo_leader.username as kigo_name', 'kigos.lection_number', 'kigos.lection', 'lector.username as lector_name', 'members.onlinename', 'sundayservices.id' )
			->join ( 'sermons', 'sundayservices.sermon_id', '=', 'sermons.id' )
			->join ( 'kigos', 'sundayservices.kigo_id', '=', 'kigos.id' )
			->join ( 'users as kigo_leader', 'kigos.user_id', '=', 'kigo_leader.id' )
			->join ( 'users as lector', 'sundayservices.user_id', '=', 'lector.id' )
			->join ( 'members', 'sermons.preacher_id', '=', 'members.id' )
			->get ();

		$kalenders=Sundayservice::all();
		
		return view ( 'sundayservices.index' )->with ( 'kalenders', $kalenders );
	}
	public function getEditsunday($sundayId) {


		$sundays = DB::table ( 'sundayservices' )
			->select ( 'sermons.preacher_id as pid','sundayservices.user_id as lid', 'kigos.user_id as kid','sermons.date', 'kigo_leader.username as kigo_name', 'kigos.lection_number', 'kigos.lection', 'lector.username as lector_name', 'members.onlinename', 'sundayservices.id' )
			->join ( 'sermons', 'sundayservices.sermon_id', '=', 'sermons.id' )
			->join ( 'kigos', 'sundayservices.kigo_id', '=', 'kigos.id' )
			->join ( 'users as kigo_leader', 'kigos.user_id', '=', 'kigo_leader.id' )
			->join ( 'users as lector', 'sundayservices.user_id', '=', 'lector.id' )
			->join ( 'members', 'sermons.preacher_id', '=', 'members.id' )
			->where( 'sundayservices.id','=', $sundayId)
			->get ();


		$kigos_list = $this->getKigoslist();
		$preachers_list = $this->getPreacherslist();
		$lectors_list = $this->getLectorslist();
		
		return view ( 'sundayservices.editsunday' )->with ( 'sundays', $sundays )->with ( 'kigos_list', $kigos_list )->with ( 'preachers_list', $preachers_list )->with ( 'lectors_list', $lectors_list );
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
			
			return redirect ( 'sundayservices' )->with ( 'message', 'success|Sonntag erfolgreich angelegt!' );
		} else {
			// validation has failed, display error messages
			return redirect ( 'sundayservices/editsunday/'.$actualSunday )->with ( 'message', 'danger|Die folgenden Fehler sind aufgetreten:' )->withErrors ( $validator )->withInput ();
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
			
			return redirect ( 'sundayservices' )->with ( 'message', 'success|Sonntag erfolgreich angelegt!' );
		} else {
			// validation has failed, display error messages
			return redirect ( 'sundayservices/newsunday' )->with ( 'message', 'danger|Die folgenden Fehler sind aufgetreten:' )->withErrors ( $validator )->withInput ();
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
		
		$validator = Validator::make ( Request::all (), Sundayservice::$rules );
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
				$sermon->date = Request::input ( 'date' . $sundays [$i] );
				
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
			return redirect ( 'sundayservices/' )->with ( 'message', 'success|Jahr erfolgreich angelegt!' );
		} else {
			// validation has failed, display error messages
			return redirect ( 'sundayservices/newyear/' . $user->member_id )->with ( 'message', 'danger|Die folgenden Fehler sind aufgetreten:' )->withErrors ( $validator )->withInput ();
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
		return DB::table ( 'users' )->lists ( 'username', 'id' );
	}
	public function getLectorslist(){
		return DB::table ( 'users' )->where ( 'permission', '<=', 1 )->lists ( 'username', 'id' );
	}
	public function getPreacherslist(){
		return DB::table ( 'members' )->lists ( 'onlinename', 'id' );
	}
}
