<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vers extends Model
{
    public function sundayservice()
    {
         return $this->hasMany('App\Models\Sundayservice', 'vers_id');
    }

    public function kigo()
    {
    	return $this->hasMany('App\Models\Kigo', 'vers_id');
    }
}
