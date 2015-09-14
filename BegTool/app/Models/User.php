<?php

namespace App\Models;



use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use DB;

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
	public function newMessages($user) {
		$systemMessage = ['receiver_id' => '0', 'sender_id' => $user->id];
		return Message::where('receiver_id', $user->id)
					->orWhere($systemMessage)
					->sum('visited');
	}
	public static function getKigoslist(){
		return User::all()->lists ( 'username', 'id' );
	}

	public static function getLectorslist(){
		return User::where ( 'permission', '<=', 1 )->lists ( 'username', 'id' );
	}

	public static function getSermonsByIdAndDate($member_id,$date){
		return Sermon::where('preacher_id','=', $member_id)->where('date','>=',$date)->get();
	}

	public static function getSundayservicesByIdAndDate($user_id,$today){
		return Sundayservice::whereHas('sermons', function($q) use ($today)
				{
				    $q->where('date','>=',$today);

				})->where('user_id','=',$user_id)->get();
	}

	public static function getKigosByIdAndDate($user_id,$today){
		return Kigo::whereHas('sundayservices', function($q) use ($today)
				{
				    $q->whereHas('sermons', function($q2) use ($today)
				    	{
				    		 $q2->where('date','>=',$today);
				    	});

				})->where('user_id','=',$user_id)->get();
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
	    'password'=>'required|alpha_num|between:6,12|confirmed',
	    'password_confirmation'=>'required|alpha_num|between:6,12',
	    'password_confirmation'=>'required|alpha_num',
		'permission' => 'required'
    );
}
