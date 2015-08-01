<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sermon extends Model
{
    public function member()
    {
        return $this->hasOne('App\Models\Member');
    }

    public function sundayservice()
    {
    	return $this->hasOne('App\Models\Sundayservice');
    }
}
