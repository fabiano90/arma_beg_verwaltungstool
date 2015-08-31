<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vers extends Model
{
    use SoftDeletes;    
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */    
    protected $dates = ['deleted_at'];

    public function sundayservice()
    {
         return $this->hasMany('App\Models\Sundayservice', 'vers_id');
    }

    public function kigo()
    {
    	return $this->hasMany('App\Models\Kigo', 'vers_id');
    }
}
