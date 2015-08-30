<?php

namespace App\Models;



use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword;
    use SoftDeletes;    
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

	public function members()
	{
	    return $this->belongsTo('App\Models\Member', 'member_id');
	}
	
	public function absences()
	{
		return $this->hasMany('App\Models\Absence', 'user_id');
	}

	public function kigos()
	{
		return $this->hasMany('App\Models\Kigo', 'user_id');
	}

	public function sundayservices()
	{
		return $this->hasMany('App\Models\Sundayservice', 'user_id');
	}	

	public function posts()
	{
	    return $this->hasMany('App\Models\Post');
	}

	public function messagesSent()
	{
	    return $this->hasMany('App\Models\Message', 'sender_id');
	}

	public function messagesReceived()
	{
	    return $this->hasMany('App\Models\Message', 'receiver_id');
	}

	public function messages()
	{
	    return Message::where('sender_id', '=', $this->id)
	    			->orWhere('receiver_id', '=', $this->id)
	    			->orderBy('updated_at', 'DESC')
	    			->get();
	}

	public function chat($partner_id = 0)
	{
		 return Message::where('receiver_id', '=', $partner_id)
	    			->where('sender_id', '=', $this->id)
	    			->orWhere('sender_id', '=', $partner_id)
	    			->where('receiver_id', '=', $this->id)
	    			->orderBy('updated_at', 'DESC')
	    			->get();
	}

	public function friends()
	{
		return $this->belongsToMany('App\Models\User', 'friend_user', 'user_id', 'friend_id');
		//tabelle, im this eigener key kennt er ja weil aktuelles objekt, also parameter bei attach( $bla) fuer friend_id
		//normalerweise immer 2 eintträge , reicht aber eine Eintrag, nur gucken ob in user id friend id drin steht.
	}	

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

	public static $rules = array(
	    'username'=>'required|unique:users|alpha|min:2',
	    'email'=>'required|email|unique:users',
	    'password'=>'required|alpha_num|between:6,12|confirmed',
	    'password_confirmation'=>'required|alpha_num|between:6,12',
	    'password_confirmation'=>'required|alpha_num',
		'permission' => 'required',
		'member_id' => 'required|unique:users'
    );
}
