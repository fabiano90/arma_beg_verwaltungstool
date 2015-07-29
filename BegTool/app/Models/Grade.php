<?php namespace Laravel5App\Models;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model {

    /* Felder:
    id: int(11)
    grade: int(11)
    user_id: int(11)
    course_id: int(11)
    created_at: datetime
    updated_at: datetime
    deleted_at: datetime
    */


	public function user()
    {
        return $this->belongsTo('Laravel5App\Models\User');
    }

    public function course()
    {
        return $this->belongsTo('Laravel5App\Models\Course');
    }

   	public static $rules = array(
	    'user_id'=>'required|numeric|min:1',
	    'course_id'=>'required|numeric|min:1',
	    'grade'=>'required|numeric|min:1'
    );

    public static function allGradesAsArray($withEmpty = false)
    {
    	$grades = array();
    	if ($withEmpty)
    	{
    		$grades['0'] = '--- bitte wählen ---';
    	}
    	for ($i = 1; $i < 4; $i++)
    	{
    		$grades[''.$i.'.0'] = ''.$i.',0';
    		$grades[''.$i.'.3'] = ''.$i.',3';
    		$grades[''.$i.'.7'] = ''.$i.',7';
    	}
        $grades['4.0'] = '4,0';
    	$grades['5.0'] = '5,0';
    	return $grades;
    }
}
