<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kigo_song extends Model
{
    public function kigo()
    {
        return $this->hasOne('App\Models\Kigo');
    }

    public function song()
    {
    	return $this->hasOne('App\Models\Song');
    }
}
