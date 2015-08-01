<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    public function user()
    {
        return $this->hasOne('App\Models\User');
    }

    public function sermon()
    {
    	return $this->hasMany( 'App\Models\sermon', 'sermon' );
    }

	public static $rules = array(
	    'firstname'=>'required|alpha|min:2',
	    'lastname'=>'required|alpha|min:2',
	    'birthdate' => 'date_format:Y-m-d|required'
    );
}
