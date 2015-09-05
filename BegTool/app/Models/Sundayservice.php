<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sundayservice extends Model
{
    use SoftDeletes;    
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */    
    protected $dates = ['deleted_at'];
    
	public function users()
	{
		return $this->belongsTo('App\Models\User', 'user_id');
	}

	public function songs(){
		return $this->belongsToMany('App\Models\Song', 'song_sundayservice', 'service_id', 'song_id' )
		->withPivot('order')
		->withPivot('songdate')
		->orderBy('order');//kigo_songs
	}

	public function vers()
	{
		return $this->belongsTo('App\Models\Vers', 'vers_id');
	}
	public function sermons(){
			return $this->belongsTo('App\Models\Sermon', 'sermon_id');
	}
		
	public function kigos(){
			return $this->belongsTo('App\Models\Kigo', 'kigo_id' );
	}

	public static function sundaysOfYear($year){

		$lastyear = $year-"1 year";
		$lastyear = strtotime("31.12.".$lastyear);
		$nextyear = $year+"1 year";
		$nextyear = strtotime("01.01.".$nextyear);

		return Sermon::where('date', '<', $nextyear )->where('date', '>', $lastyear )->get();

	}



	public function sundayservicesAfterDate($filter){
		if($filter==1){
			$datetime=time();	
		}else{
			$datetime=$filter;
		}
		return Sundayservice::whereHas('sermons', function($q) use ($datetime)
				{
				    $q->where('date','>=',$datetime);
				})->get();
	}

	public static $rulesdate = array(
			'date' => 'unique:sermons'
			
	);

	public static $rules = array(
			'date' => 'date_format:d.m.Y|required' ,
			'lection_number'=>'numeric'
	);
	
	public static $rulesedit = array(			
			'lection_number'=>'numeric'
	);

}

