<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kigo extends Model
{
    public function user()
    {
        return $this->hasOne('App\Models\User');
    }
    public function kigo_song() {
    	return $this->hasMany( 'App\Models\Kigo_song', 'kigo_song' );
    }
    public function vers()
    {
    	return $this->hasOne('App\Models\Vers');
    }
}
