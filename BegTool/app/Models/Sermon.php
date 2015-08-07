<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sermon extends Model
{
    public function members()
    {
        return $this->belongsTo('App\Models\Member', 'preacher_id');
    }

    public function sundayservices()
    {
    	return $this->hasOne('App\Models\Sundayservice');
    }
    
    public static $rules = array(
    		'lection_number'=>'num',
    );
}
