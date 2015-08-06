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
		$kalenders = DB::table('sundayservices')
					->join('sermons', 'sundayservices.sermon_id', '=','sermons.id')
					->join('kigos', 'sundayservices.kigo_id', '=','kigos.id')
					->join('users as kigo_leader', 'kigos.user_id', '=','kigo_leader.id')
					->join('users as lector', 'sundayservices.user_id', '=','lector.id')
					->join('members', 'sermons.preacher_id', '=','members.id')
					->select('sermons.date', 'kigo_leader.username as kigo_name', 'kigos.lection_number', 'kigos.lection', 'lector.username as lector_name', 'members.onlinename')
					->get();

		return view ( 'sundayservices.index' )->with ( 'kalenders', $kalenders );
	}
	public function getNewsunday() {
		$kigos_list = DB::table('users')->where('permission', 2)->lists('username', 'id');
		$preachers_list = DB::table('members')->lists('onlinename', 'id');
		$lectors_list = DB::table('users')->where('permission', '<=', 1)->lists('username', 'id');
		
		return view ( 'sundayservices.newsunday' )->with('kigos_list', $kigos_list)->with('preachers_list',$preachers_list)->with('lectors_list',$lectors_list);
	}
	
	public function postNewsunday(){
		$sundayservice = new Sundayservice;
		$kigo = new Kigo;
		$sermon = new Sermon;
		
		/**** Kigo id suchen und speichern ****/
		$kigoleader_id = Request::input('kigos_list');
		$kigo->user_id = $kigoleader_id;
		$kigo->lection = Request::input('lection');
		$kigo->lection_number = Request::input('lection_number');
		$kigo->save();
		
		/**** Preacher id + date suchen und speichern ****/
		$sermon->preacher_id = Request::input('preachers_list');
		$sermon->date = Request::input('date');
		$sermon->save();
		
		/**** Preacher id suchen****/
		$lector_id = Request::input('lectors_list');
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
		$kigos_list = DB::table('users')->where('permission', 2)->lists('username', 'id');
		$preachers_list = DB::table('members')->lists('onlinename', 'id');
		$lectors_list = DB::table('users')->where('permission', '<=', 1)->lists('username', 'id');
		return view ( 'sundayservices.newYear' )->with ( 'sundays', $sundays )->with('kigos_list', $kigos_list)->with('preachers_list',$preachers_list)->with('lectors_list',$lectors_list)->with('year',$year);
	}
	public function postNewyear() {
		$year = Request::input('year');
		$sundays = $this->sundaysYear ( $year );
		
		
		for($i = 0; $i < 52; $i ++) {
		
			$sundayservice = new Sundayservice;
			$kigo = new Kigo;
			$sermon = new Sermon;
			
			/**** Kigo suchen und speichern ****/
			$kigoleader_id = Request::input('kigos_list'.$sundays[$i]);
			$kigo->user_id = $kigoleader_id;
			$kigo->lection = Request::input('lection'.$sundays[$i]);
			$kigo->lection_number = Request::input('lection_number'.$sundays[$i]);
			
			
			/**** Preacher id + date suchen und speichern ****/
			$preacher_id = Request::input('preachers_list'.$sundays[$i]);
			$sermon->preacher_id = $preacher_id;
			$sermon->date = Request::input('date'.$sundays[$i]);
			
			
			/**** Lector id suchen****/
			$lector_id = Request::input('lectors_list'.$sundays[$i]);
			$sundayservice->user_id = $lector_id;
			
			$sermon->save();
			$kigo->save();
			/**** Kigo und Sermon id suchen und Speichern****/
			$kigo_id = Kigo::orderBy('id', 'DESC')->first();
			$sermon_id =Sermon::orderBy('id', 'DESC')->first();
			$sundayservice->user_id = $lector_id;
			$sundayservice->kigo_id = $kigo_id->id;
			$sundayservice->sermon_id = $sermon_id->id;
			$sundayservice->save();			
			
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
