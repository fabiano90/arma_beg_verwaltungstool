<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model {
	public function users() {
		return $this->hasOne ( 'App\Models\User' );
	}
	public function sermons() {
		return $this->hasMany ( 'App\Models\sermon', 'preacher_id' );
	}

	public static function getPreacherslist(){
		return Member::all()->lists ( 'onlinename', 'id' );
	}
	public static $rules = array (
			'firstname' => 'required|alpha|min:2',
			'lastname' => 'required|alpha|min:2',
			'birthdate' => 'date_format:d.m.Y' ,
			'onlinename' => 'required|unique:members'
	);
}
