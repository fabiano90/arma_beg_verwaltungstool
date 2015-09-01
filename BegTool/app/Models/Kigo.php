<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kigo extends Model {

    use SoftDeletes;    
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

	public function users() {
		return $this->belongsTo ( 'App\Models\User', 'user_id' );
	}
	
	public function songs(){
		return $this->belongsToMany('App\Models\Song');//kigo_songs
	}
	
	public function vers() {
		return $this->belongsTo ( 'App\Models\Vers', 'vers_id' );
	}
	
	public function sundayservices() {
		return $this->hasOne('App\Models\Sundayservice');
	}

	public static $rules = array(
		'lection_number'=>'numeric',
		'lection' => 'string',
		'conclusion' => 'string',
		'material' => 'string' ,
		'crafting' => 'string'
	);	
}
