<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kigo extends Model {

	public function users() {
		return $this->belongsTo ( 'App\Models\User', 'user_id' );
	}
	
	//public function kigo_song() {
	//	return $this->hasMany ( 'App\Models\Kigo_song', 'kigo_id' );
	//}
	public function songs(){
		return $this->belongsToMany('App\Models\Song');//kigo_songs
	}
	
	public function vers() {
		return $this->belongsTo ( 'App\Models\Vers', 'vers_id' );
	}
	
	public function sundayservices() {
		return $this->hasOne('App\Models\Sundayservice');
	}
	public static $rules = array(
			'lection_number'=>'num',
	);
}
