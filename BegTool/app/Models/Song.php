<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Song extends Model {

    use SoftDeletes;    
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */    
    protected $dates = ['deleted_at'];

	public function kigos(){
		return $this->belongsToMany('App\Models\Kigo' , 'service_id');//kigo_songs
	}
	public function sundayservices(){
		return $this->belongsToMany('App\Models\Sundayservice', 'song_sundayservice', 'song_id', 'service_id')->withPivot('order');//kigo_songs
	}
	public static function songsOrder($songs, $sunday){
	$songsOrder = array(1 => "",2 => "",3 => "",4 => "",5 => "",6 => "");
			foreach ($sunday->songs as $song) {
				$songsOrder[$song->pivot->order] = $song->number.' '.$song->name;
			}
	return $songsOrder;
	}
	public static $rules = array (
		'number' => 'numeric',
		'name' => 'required|string|min:2',
		'annotation' => 'string'
	);
}
