@extends('layouts.main')

@section('content')
    <h2>{!! $member->firstname!!} {!! $member->lastname!!} als Mitarbeiter anlegen</h2>
		{!! Form::open(array('url'=>'users/register', 'class'=>'form-signup')) !!}		
		<div class="hidden">
			{!! Form::text('member_id', $member->id, array('class'=>'form-control ', 'placeholder'=>'Nachname'))!!}
		</div>
		{!! Form::label('firstname', 'Vorname') !!}
		{!! Form::text('firstname', $member->firstname, array('class'=>'form-control ', 'placeholder'=>'Nachname', 'disabled'=>'disabled')) !!}
    	{!! Form::label('lastname', 'Nachname') !!}
    	{!! Form::text('lastname', $member->lastname, array('class'=>'form-control ', 'placeholder'=>'Nachname', 'disabled'=>'disabled')) !!}
	    {!! Form::label('birthdate', 'Geburtsdatum') !!}
	    {!! Form::text('birthdate', date('d.m.Y', $member->birthdate), array('class'=>'form-control ', 'placeholder'=>'Nachname', 'disabled'=>'disabled')) !!}      

    	{!! Form::label('username', 'Benutzername') !!}
   	 	{!! Form::text('username', $member->firstname, array('class'=>'form-control', 'placeholder'=>'Benutzername')) !!}

		{!! Form::label('email', 'E-Mail') !!}
	    {!! Form::text('email', null, array('class'=>'form-control', 'placeholder'=>'E-Mail')) !!}
	    {!! Form::label('password', 'Passwort') !!}
	    {!! Form::password('password', array('class'=>'form-control', 'placeholder'=>'')) !!}
	    {!! Form::label('password_confirmation', 'Passwort wiederholen') !!}
	    {!! Form::password('password_confirmation', array('class'=>'form-control', 'placeholder'=>'Passwort wiederholen')) !!}

		{!! Form::label('permission', 'Berechtigungen') !!}
		<div class="form-inline">
			{!! Form::radio('permission', 0) !!}
			{!! Form::label('admin', 'Admin') !!}<br/>
			{!! Form::radio('permission', 1) !!}
			{!! Form::label('preacher', 'Prediger') !!}<br/>
			{!! Form::radio('permission', 2) !!}
			{!! Form::label('kigo', 'Kigo') !!}<br/>
		</div>

		{!! Form::submit('Speichern', array('class'=>'btn btn-large btn-primary btn-block'))!!}
		{!! Form::close() !!}
@stop