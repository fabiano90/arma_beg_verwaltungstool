<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Song extends Model {


	public function kigos(){
		return $this->belongsToMany('App\Models\Kigo' , 'service_id');//kigo_songs
	}
	public function sundayservices(){
		return $this->belongsToMany('App\Models\Sundayservice', 'song_sundayservice', 'song_id', 'service_id')->withPivot('order');//kigo_songs
	}
}
