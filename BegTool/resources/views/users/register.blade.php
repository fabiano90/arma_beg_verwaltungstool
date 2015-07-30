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
		<div class="form-inline">
			{!! Form::radio('permission', 'admin') !!}
			{!! Form::label('admin', 'Admin') !!}<br/>
			{!! Form::radio('permission', 'preacher') !!}
			{!! Form::label('preacher', 'Prediger') !!}<br/>
			{!! Form::radio('permission', 'kigo') !!}
			{!! Form::label('kigo', 'Kigo') !!}<br/>
		</div>

		{!! Form::submit('Speichern', array('class'=>'btn btn-large btn-primary btn-block'))!!}
		{!! Form::close() !!}
@stop