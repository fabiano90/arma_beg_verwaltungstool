<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sundayservice extends Model
{
	public function user()
	{
		return $this->belongsTo('App\Models\User', 'user_id');
	}
	public function service_song() {
		return $this->hasMany( 'App\Models\Service_song', 'service_id' );
	}
	public function vers()
	{
		return $this->belongsTo('App\Models\Vers', 'vers_id');
	}
	public function sermon()
	{
		return $this->belongsTo('App\Models\Sermon', 'sermon_id');
	}
	public function kigo(){
		return $this->hasOne('App\Models\Kigo');
	}
	
	public static $rules = array(
			'date' => 'date_format:d.m.Y|required' ,
			'lection_number'=>'numeric'
	);
	
}

