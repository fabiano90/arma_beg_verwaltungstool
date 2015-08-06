<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Song extends Model {

	public function service_song() {
		return $this->hasMany( 'App\Models\Service_song', 'song_id' );
	}
	//public function kigo_song() {
	//	return $this->hasMany( 'App\Models\Kigo_song', 'song_id' );
	//}
	public function kigos(){
		return $this->belongsToMany('App\Models\Kigo');//kigo_songs
	}
	public function songs(){
		return $this->belongsToMany('App\Models\Sundayservice');//kigo_songs
	}
}
