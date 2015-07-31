<?php

namespace App\Http\Controllers;

use Request;
use App\Models\Sundayservice;
use App\Models\User;

class SundayserviceController extends Controller {
	public function getIndex() {
		$sundayservices = Sundayservice::all ();
		return view ( 'sundayservices.index' )->with ( 'sundayservices', $sundayservices );
	}
	public function getNewyear($year) {
		$startDate = strtotime ( $year . '-01-01 23:59:59' );
		$sundays [0] = 0;
		$nextYear = $year + 1;

		for($i = 0; strcmp ( date ( 'd.m.Y', $startDate ), '01.01.' . $nextYear ) != 0; $i ++) {
			
			if (strcmp ( date ( 'D', $startDate ), 'Sun' ) == 0) {
				$sundays [$i] = $startDate;
			}
			$startDate = strtotime ( '+1 day', $startDate );
		}
		
		// $sundayservices = new Sundayservices();
		return view ( 'sundayservices.newYear' )->with ( 'sundays', $sundays );
	}
}
