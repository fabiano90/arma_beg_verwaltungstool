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

}

