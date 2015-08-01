<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Song extends Model {

	public function service_song() {
		return $this->hasMany( 'App\Models\Service_song', 'song_id' );
	}
	public function kigo_song() {
		return $this->hasMany( 'App\Models\Kigo_song', 'song_id' );
	}
}
