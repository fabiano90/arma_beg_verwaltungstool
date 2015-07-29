<?php namespace Laravel5App\Http\Controllers;

use Laravel5App\Models\User;
use Laravel5App\Models\Course;
use Laravel5App\Models\Semester;
use Laravel5App\Models\Grade;
use Validator;
use View;
use Request;
use Hash;

class UserController extends BaseController {
    /**
     * index-Action
     */
    public function getIndex()
    {
    	$users = User::paginate(15);
        return view('users.index')->with('users', $users);
    }

    /**
     * new-Action
     */
    public function getNew()
    {
    	$user = new User();
        return view('users.new')->with('user', $user);
    }

    /**
     * new-Action (Formularauswertung)
     */
    public function postNew()
    {
		$validator = Validator::make(Request::all(), User::$rules);
 
    	if ($validator->passes()) 
    	{
        	// validation has passed, save user in DB
        	$user = new User;
		    $user->firstname = Request::input('firstname');
		    $user->lastname = Request::input('lastname');
		   // $user->username = Request::input('username');
		    //$user->email = Request::input('email');
		    $user->birthdate = Request::input('birthdate');
		   /* $user->password = Hash::make(Request::input('password'));*/
		    $user->save();
		 
		    return redirect('users')->with('message', 'success|Student erfolgreich angelegt!');
    	} 
    	else 
    	{
        	// validation has failed, display error messages   
        	return redirect('users/new')->with('message', 'danger|Die folgenden Fehler sind aufgetreten:')->withErrors($validator)->withInput();
    	}
    }

    /**
     * edit-Action (Formularauswertung)
     */
    public function postEdit($id)
    {
        $user = User::find($id);
        $rules = User::$rules;
        //$rules['username'] = '';
        //$rules['password'] = '';
        //$rules['password_confirmation'] = '';
        //$rules['email'] = 'required|email|unique:users,email,'.$user->id;
        $validator = Validator::make(Request::all(), $rules);
 
        if ($validator->passes()) 
        {
            // validation has passed, save user in DB
            
            $user->firstname = Request::input('firstname');
            $user->lastname = Request::input('lastname');
            //$user->email = Request::input('email');
            $user->birthdate = Request::input('birthdate');
           // $user->password = Hash::make(Request::input('password'));
            $user->save();
         
            return redirect('users/index')->with('message', 'success|Student wurde erfolgreich gespeichert!');
        } 
        else 
        {
            // validation has failed, display error messages   
            return redirect('users/edit/'.$user->id)->with('message', 'danger|Die folgenden Fehler sind aufgetreten:')->withErrors($validator)->withInput();
        }
    }

    /**
     * edit-Action
     */
    public function getEdit($id = 0)
    {
        $user = User::find($id);
        return view('users.edit')->with('user', $user);
    }

    /**
     * addgrade-Action
     */
    public function getAddgrade($id = 0)
    {
        $user = User::find($id);
        $courseArray = Course::orderBy('title', 'asc')->get();
        $courses = array('0' => '--- bitte wählen ---');
        $gradesArray = $user->grades;
        foreach($courseArray as $course)
        {
            $courses[$course->id] = $course->title.' ('.$course->semester->title.')';
        }
        return view('users.addgrade')->with('user', $user)->with('courses', $courses)->with('grades', Grade::allGradesAsArray(true));
    }

    /**
     * addgrade-Action (Formularauswertung)
     */
    public function postAddgrade()
    {
        $user = User::find(Request::input('user_id'));
        $rules = Grade::$rules;
        $validator = Validator::make(Request::all(), $rules);
 
        $grades = Grade::where('user_id', '=', Request::input('user_id'))->where('course_id', '=', Request::input('course_id'))->get();
        if(count($grades) > 0)
        {
            return redirect('users/addgrade/'.$user->id)->with('message', 'danger|Für diesen Kurs lieg bereits eine Note vor.')->withInput();
        }
        else if ($validator->passes()) 
        {
            // validation has passed, save user in DB
            $grade = new Grade;
            $grade->user_id = Request::input('user_id');
            $grade->course_id = Request::input('course_id');
            $grade->grade = Request::input('grade');
            $grade->save();
         
            return redirect('users/index')->with('message', 'success|Note wurde erfolgreich gespeichert!');
        } 
        else 
        {
            // validation has failed, display error messages   
            return redirect('users/addgrade/'.$user->id)->with('message', 'danger|Die folgenden Fehler sind aufgetreten:')->withErrors($validator)->withInput();
        }
    }


    /**
     * show-Action
     */
    public function getShow($id = 0)
    {
        $user = User::find($id);
        return view('users.show')->with('user', $user);
    }

    /**
     * delete-Action
     */
    public function getDelete($id)
    {
        $user = User::find($id);
        $user->deleteCascade();
        return redirect('users/index')->with('message', 'success|Student wurde erfolgreich gelöscht!');
    }

}
