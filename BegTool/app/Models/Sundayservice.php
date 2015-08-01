<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sundayservice extends Model
{
	public function user()
	{
		return $this->hasOne('App\Models\User');
	}
	public function song() {
		return $this->hasMany( 'App\Models\Service_song', 'service_song' );
	}
	public function vers()
	{
		return $this->hasOne('App\Models\Vers');
	}
	public function sermon()
	{
		return $this->hasOne('App\Models\Sermon');
	}
}

