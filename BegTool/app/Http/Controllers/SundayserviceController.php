<?php

namespace App\Http\Controllers;

use Request;
use App\Models\Sundayservice;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class SundayserviceController extends Controller {
	public function getIndex() {
		$sundayservices = Sundayservice::all ();
		return view ( 'sundayservices.index' )->with ( 'sundayservices', $sundayservices );
	}
	public function getNewsunday(){
		
			
		$users=User::all();
			// queries the clients db table, orders by client_name and lists client_name and id
			$client_optons = $users->users()->orderBy('username', 'asc')->lists('username','id');
		
			return View::make('sundayservices.newSunday', array('client_options' => $client_options));
		
		
		
	}
	
	
	
	
	
	
	public function getNewyear($year) {

		$sundays = $this->sundaysYear($year);
		$users = User::all();
		$sundayservices = Sundayservice::all();
		return view ( 'sundayservices.newYear' )->with ( 'sundays', $sundays )->with('users', $users);
	
	}
	public function postNewyear(){

		for($i=0;$i<52;$i++){
		$sundayservices = new Sudayservice();
		$sundayservices->user_id = Request::input('user_id'.$i);
		$sundayservices->username = Request::input('username');
		$sundayservices->email = Request::input('email');
		$sundayservices->password = Hash::make(Request::input('password'));
		$sundayservices->permission = 2;//intval(Request::input('permission'));
	

	
		$user->save();
		}
		return redirect('users')->with('message', 'success|Jahr erfolgreich angelegt!');

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
