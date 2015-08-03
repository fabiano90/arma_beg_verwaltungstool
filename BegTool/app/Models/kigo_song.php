<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kigo_song extends Model
{
    public function kigo()
    {
        return $this->belongsTo('App\Models\Kigo', 'kigo_id');
    }

    public function song()
    {
    	return $this->belongsTo('App\Models\Song', 'song_id');
    }
}