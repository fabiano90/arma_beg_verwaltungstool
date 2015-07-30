@extends('layouts.main')

@section('content')
    <h2>Registrierung</h2>
		{!! Form::open(array('url'=>'users/register', 'class'=>'form-signup')) !!}

		{!! Form::label('firstname', 'Vorname') !!}
		{!! Form::text('firstname', null, array('class'=>'form-control', 'placeholder'=>'Vorname')) !!}
    	{!! Form::label('lastname', 'Nachname') !!}
    	{!! Form::text('lastname', null, array('class'=>'form-control', 'placeholder'=>'Nachname')) !!}
    	{!! Form::label('username', 'Benutzername') !!}
   	 	{!! Form::text('username', null, array('class'=>'form-control', 'placeholder'=>'Benutzername')) !!}

		{!! Form::label('email', 'E-Mail') !!}
	    {!! Form::text('email', null, array('class'=>'form-control', 'placeholder'=>'E-Mail')) !!}
	    {!! Form::label('password', 'Passwort') !!}
	    {!! Form::password('password', array('class'=>'form-control', 'placeholder'=>'')) !!}
	    {!! Form::label('password_confirmation', 'Passwort wiederholen') !!}
	    {!! Form::password('password_confirmation', array('class'=>'form-control', 'placeholder'=>'Passwort wiederholen')) !!}


    	{!! Form::label('permission', 'Berechtigungen') !!}
	    <div class="btn-group" data-toggle="buttons">
            <label class="btn btn-default">
                <input type="radio" id="q156" name="quality[25]" value="1" /> 1
            </label> 
            <label class="btn btn-default">
                <input type="radio" id="q157" name="quality[25]" value="2" /> 2
            </label> 
            <label class="btn btn-default active">
                <input type="radio" id="q160" name="quality[25]" checked="checked" value="3" /> 3
            </label>
        </div>
   	 	{!! Form::text('permission', null, array('class'=>'form-control', 'placeholder'=>'Berechtigungen')) !!}

   	 	<div class="btn-group" data-toggle="buttons">
    		{!! Form::label('permission', 'Berechtigungen') !!}

		//array('class' => 'btn btn-default')
		{!! Form::submit('Speichern', array('class'=>'btn btn-large btn-primary btn-block'))!!}
		{!! Form::close() !!}
@stop