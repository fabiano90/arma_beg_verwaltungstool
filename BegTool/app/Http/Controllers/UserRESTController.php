<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;

use App\Models\User;

use Request;
use Auth;
use Hash;

class UserRESTController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    	$users = User::all();
    	$response = new \stdClass;
    	$response->success = true;
    	$response->total = count($users);
    	$response->data = $users;

    	return response()->json($response);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
        echo 'create';
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        //
        $user = new User();
        $user->firstname = Request::input('firstname');
        $user->lastname = Request::input('lastname');
        $user->email = Request::input('email');
        $user->password = Hash::make(Request::input('password'));
        $user->username = Request::input('username');
        $user->save();
        $response = new \stdClass;
    	$response->success = true;
    	$response->total = 1;
    	$response->data = $user;

    	return response()->json($response);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
        echo 'show: '.$id;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
        echo 'edit: '.$id;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        //
        $user = User::find($id);
        $user->firstname = Request::input('firstname');
        $user->lastname = Request::input('lastname');
        $user->email = Request::input('email');
        $user->save();
        $response = new \stdClass;
    	$response->success = true;
    	$response->total = 1;
    	$response->data = $user;

    	return response()->json($response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
        
        $user = User::find($id);
        $user->delete();
        $response = new \stdClass;
    	$response->success = true;

    	return response()->json($response);
    
    }
}
