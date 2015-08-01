<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Song_sundayservice extends Model
{
    public function sundayservice()
    {
        return $this->belongsTo('App\Models\Sundayservices', 'service_id');
    }

    public function song()
    {
    	return $this->belongsTo('App\Models\Song', 'song_id');
    }
}
