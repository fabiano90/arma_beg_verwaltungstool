<?php namespace Laravel5App\Models;
use Illuminate\Database\Eloquent\Model;

use Laravel5App\Models\Grade;

class User extends Model {

	/* Felder:
    id: int(11)
	email: varchar(255)
	firstname: varchar(255)
	lastname: varchar(255)
	username: varchar(255)
	password: varchar(255)
	barcode: varchar(255)
	street: varchar(255)
	number: varchar(255)
	postalcode: varchar(255)
	city: varchar(255)
	phone1: varchar(255)
	phone2: varchar(255)
	birthdate: date
	role: varchar(255)
	created_at: datetime
	updated_at: datetime
	deleted_at: datetime
	remember_token: varchar(255)
    */


	public function grades()
    {
        return $this->hasMany('Laravel5App\Models\Grade');
    }

    public function deleteCascade()
    {
    	Grade::where('user_id', '=', $this->id)->delete();
    	$this->delete();
    }

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');


	public static $rules = array(
	    'firstname'=>'required|alpha|min:2',
	    'lastname'=>'required|alpha|min:2',
	    //'email'=>'required|email|unique:users',
	    //'password'=>'required|alpha_num|between:6,12|confirmed',
	    //'password_confirmation'=>'required|alpha_num|between:6,12',
	    'birthdate' => 'date_format:Y-m-d|required'
    );
}
