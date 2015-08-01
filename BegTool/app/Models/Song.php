<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Song extends Model {
	public function serviceSong() {
		return $this->hasMany( 'App\Models\Service_song', 'service_song' );
	}
	public function kigoSong() {
		return $this->hasMany( 'App\Models\Kigo_song', 'kigo_song' );
	}
	

}
