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
		$kigoAndLeader = DB::table('kigos')
			->join('users', 'kigos.user_id', '=','users.id')
			->select('kigos.id', 'users.username', 'lection_number', 'lection', 'conclusion', 'material', 'crafting')
			->get();

		//$kigos = Kigo::paginate(10);
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
