<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vers extends Model
{
    public function sundayservice()
    {
         return $this->hasMany('App\Models\Sundayservice', 'sundayservice');
    }

    public function kigo()
    {
    	return $this->hasMany('App\Models\Kigo', 'kigo');
    }
}
