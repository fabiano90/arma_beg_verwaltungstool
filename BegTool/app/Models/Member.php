<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Member extends Model {

    use SoftDeletes;    
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */    
    protected $dates = ['deleted_at'];

	public function users() {
		return $this->hasOne ( 'App\Models\User' );
	}
	public function sermons() {
		return $this->hasMany ( 'App\Models\sermon', 'preacher_id' );
	}

	public static $rules = array (
			'firstname' => 'required|alpha|min:2',
			'lastname' => 'required|alpha|min:2',
			'birthdate' => 'date_format:d.m.Y' ,
			'onlinename' => 'required|unique:members'
	);
}
