<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kigo extends Model {
	public function user() {
		return $this->belongsTo ( 'App\Models\User', 'user_id' );
	}
	
	public function kigo_song() {
		return $this->hasMany ( 'App\Models\Kigo_song', 'kigo_id' );
	}
	
	public function vers() {
		return $this->belongsTo ( 'App\Models\Vers', 'vers_id' );
	}
	
	public function sundayservice() {
		return $this->belongsTo ( 'App\Models\Sundayservice', 'kigo_id' );
	}
	public static $rules = array(
			'lection_number'=>'num',
	);
}
