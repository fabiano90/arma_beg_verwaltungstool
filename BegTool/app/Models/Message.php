<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends Model
{
    use SoftDeletes;    
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

	public function sender()
	{
	    return $this->belongsTo('App\Models\User', 'sender_id');
	}

	public function receiver()
	{
	    return $this->belongsTo('App\Models\User', 'receiver_id');
	}
	public function newMessages($user) {
		$systemMessage = ['receiver_id' => '0', 'sender_id' => $user->id];
		return DB::table('messages')->where('receiver_id', $user->id)->orWhere($systemMessage)->sum('visited');
	}
}

