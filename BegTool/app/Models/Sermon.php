<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sermon extends Model
{
    public function member()
    {
        return $this->belongsTo('App\Models\Member', 'preacher_id');
    }

    public function sundayservice()
    {
    	return $this->hasOne('App\Models\Sundayservice');
    }
}
