<?php

namespace App\Http\Controllers;

use Request;
use Auth;
use App\Models\Sundayservice;
use App\Models\Sermon;
use App\Models\Song;
use Illuminate\Database\Eloquent\Model;

class SermonController extends Controller {

	public function getIndex() {
		$sermons = Sermon::all();
		return view ('sermons.index')->with('sermons', $sermons);
	}

	public function getEditsermon($sermon_id){
		$auth_user = Auth::user();
		if($auth_user->permission <= 1){
			$sermon = Sermon::find($sermon_id);
			return view('sermons.editsermon')->with('sermon', $sermon);
		}
		return redirect('sermons');
	}

	public function postEditsermon($sermon_id, $count){

			$sermon = Sermon::find($sermon_id);
			$sermon->scripture = Request::input('scripture');
			$sermon->topic = Request::input('topic0');
			$tempString = '';
			for($i = 1; $i < $count; $i++){				
				$tempString .= '<li>' . Request::input('subitem' . $i) . '</li>';
			}
			$sermon->subitem = $tempString;
			$sermon->series = Request::input('series');
			$sermon->book = Request::input('book');
			$sermon->occasion = Request::input('occasion');
			$sermon->info_text = Request::input('info_text');
			$sermon->link = Request::input('link');
			$sermon->save();
		    return redirect('sermons')->with('message', 'success|Predigt erfolgreich angelegt!');
	}

    public function getDeletesermon($sermon_id) {
    	$auth_user = Auth::user();
    	if($auth_user->permission <= 1){
    		$sermon = Sermon::find($sermon_id);		
			$sermon->scripture = null;
			$sermon->topic = null;
			$sermon->subitem = null;
			$sermon->series = null;
			$sermon->book = null;
			$sermon->occasion = null;
			$sermon->info_text = null;
			$sermon->link = null;
			$sermon->save();
	    }
        return redirect('sermons')->with('message', 'success|Predigt wurde erfolgreich gelöscht!');
    }    	
}
