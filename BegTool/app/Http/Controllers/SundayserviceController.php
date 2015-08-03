<?php

namespace App\Http\Controllers;

use Request;
use App\Models\Sundayservice;
use App\Models\User;
use App\Models\Kigo;
use App\Models\Sermon;
use Illuminate\Database\Eloquent\Model;
use DB;

class SundayserviceController extends Controller {
	public function getIndex() {
		$sundayservices = Sundayservice::all ();
		return view ( 'sundayservices.index' )->with ( 'sundayservices', $sundayservices );
	}
	public function getNewsunday() {
		return view ( 'sundayservices.newsunday' );
	}
	
	public function postNewsunday(){
		$sundayservice = new Sundayservice;
		$kigo = new Kigo;
		$sermon = new Sermon;
		
		/**** Kigo id suchen und speichern ****/
		$kigoleader = Request::input('kigoleader');
		$kigoleader_id = DB::table('users')->where('username', $kigoleader)->value('id');
		$kigo->user_id = $kigoleader_id;
		$kigo->save();
		
		/**** Preacher id + date suchen und speichern ****/
		$preacher = Request::input('preacher');
		$preacher_id = DB::table('members')->where('onlinename', $preacher)->value('id');
		$sermon->preacher_id = $preacher_id;
		$sermon->date = Request::input('date');
		$sermon->save();
		
		/**** Preacher id suchen****/
		$lector = Request::input('lector');
		$lector_id = DB::table('users')->where('username', $lector)->value('id');
		$sundayservice->user_id = $lector_id;
		
		/**** Kigo und Sermon id suchen und Speichern****/
		$kigo_id = Kigo::orderBy('created_at', 'DESC')->first();
		$sermon_id =Sermon::orderBy('created_at', 'DESC')->first();
		$sundayservice->user_id = $lector_id;
		$sundayservice->kigo_id = $kigo_id->id;
		$sundayservice->sermon_id = $sermon_id->id;
		$sundayservice->save();
		
		
		return redirect('sundayservices')->with('message', 'success|Sonntag erfolgreich angelegt!');
		
	}
	
	
	
	
	public function getNewyear($year) {
		$sundays = $this->sundaysYear ( $year );
		$users = User::all ();
		$sundayservices = Sundayservice::all ();
		return view ( 'sundayservices.newYear' )->with ( 'sundays', $sundays )->with ( 'users', $users );
	}
	public function postNewyear() {
		for($i = 0; $i < 52; $i ++) {
			$sundayservices = new Sudayservice ();
			$sundayservices->user_id = Request::input ( 'user_id' . $i );
			$sundayservices->username = Request::input ( 'username' );
			$sundayservices->email = Request::input ( 'email' );
			$sundayservices->password = Hash::make ( Request::input ( 'password' ) );
			$sundayservices->permission = 2; // intval(Request::input('permission'));
			
			$user->save ();
		}
		return redirect ( 'users' )->with ( 'message', 'success|Jahr erfolgreich angelegt!' );
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
}
