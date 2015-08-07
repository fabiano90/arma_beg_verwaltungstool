<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sundayservice extends Model
{
	public function users()
	{
		return $this->belongsTo('App\Models\User', 'user_id');
	}

	//public function service_song() {
	//	return $this->hasMany( 'App\Models\Service_song', 'service_id' );
	//}

	public function songs(){
		return $this->belongsToMany('App\Models\Song');//kigo_songs
	}

	public function vers()
	{
		return $this->belongsTo('App\Models\Vers', 'vers_id');
	}

	public function sermons()
	{
		return $this->belongsTo('App\Models\Sermon', 'sermon_id');
	}
	
	public function kigos(){
		return $this->belongsTo('App\Models\Kigo', 'kigo_id' );
	}
	
	public static $rules = array(
			'date' => 'date_format:d.m.Y|required' ,
			'lection_number'=>'numeric'
	);
	
}

