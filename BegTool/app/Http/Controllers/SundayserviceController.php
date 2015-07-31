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
	
}
