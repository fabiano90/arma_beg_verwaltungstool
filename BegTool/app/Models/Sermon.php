<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sermon extends Model
{
    use SoftDeletes;    
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */    
    protected $dates = ['deleted_at'];

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
