<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service_song extends Model
{
    public function sundayservices()
    {
        return $this->hasOne('App\Models\Sundayservices');
    }

    public function song()
    {
    	return $this->hasOne('App\Models\Song');
    }
}
