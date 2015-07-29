<?php namespace Laravel5App\Http\Controllers;

use Laravel5App\Models\Grade;
use Laravel5App\Models\Course;
use Laravel5App\Models\User;

class GradeController extends BaseController {

    /**
     * new-Action
     */
    public function getNew()
    {
    	$grade = new Grade();
        $courseArray = Course::orderBy('title', 'asc')->get();
        $courses = array('0' => '--- bitte wählen ---');
        foreach($courseArray as $course)
        {
            $courses[$course->id] = $course->title.' ('.$course->semester->title.')';
        }
        $userArray = User::orderBy('lastname', 'asc')->orderBy('firstname', 'asc')->get();
        $users = array('0' => '--- bitte wählen ---');
        foreach($userArray as $user)
        {
            $users[$user->id] = $user->lastname.', '.$user->firstname;
        }
        return view('grades.new')->with('users', $users)->with('courses', $courses)->with('grades', Grade::allGradesAsArray(true));
    }
}
