<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Song extends Model {

	public function service_song() {
		return $this->hasMany( 'App\Models\Service_song', 'service_song' );
	}
	public function kigo_song() {
		return $this->hasMany( 'App\Models\Kigo_song', 'kigo_song' );
	}
}
