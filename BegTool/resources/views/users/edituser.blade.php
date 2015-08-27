@extends('layouts.main')

@section('content')
	@if($auth_user->permission > 0)
		<h2>Sie sind nicht berechtigt Mitarbeiter {!! $user->username !!} ({!! $member->firstname!!} {!! $member->lastname!!}) zu bearbeiten</h2>
		{!! HTML::link('#', 'Zurück', array('class' => 'btn btn-default', 'onClick="javascript:history.back();return false;"'))!!}
	@else
    	<h2>Mitarbeiter {!! $user->username !!} ({!! $member->firstname!!} {!! $member->lastname!!}) bearbeiten</h2>

		{!! Form::open(array('url'=>'users/edituser/'.$user->id, 'class'=>'form-signup')) !!}
		{!! showMessageAndErrors(Session::get('message'), $errors->all()) !!}
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
	    {!! Form::text('email', $user->email, array('class'=>'form-control', 'placeholder'=>'E-Mail')) !!}

		{!! Form::label('permission', 'Berechtigungen') !!}
		<div class="form-inline">
			@if($user->permission == 0)
				{!! Form::radio('permission', 0, true) !!}
			@else
				{!! Form::radio('permission', 0, false) !!}
			@endif
			{!! Form::label('admin', 'Admin') !!}<br/>
			@if($user->permission == 1)
				{!! Form::radio('permission', 1, true) !!}
			@else
				{!! Form::radio('permission', 1, false) !!}
			@endif
			{!! Form::label('preacher', 'Prediger') !!}<br/>
			@if($user->permission == 2)
				{!! Form::radio('permission', 2, true) !!}
			@else
				{!! Form::radio('permission', 2, false) !!}
			@endif
			{!! Form::label('kigo', 'Kigo') !!}<br/>

		</div>

		{!! Form::submit('Speichern', array('class'=>'btn btn-large btn-primary btn-block'))!!}
		{!! Form::close() !!}
		{!! HTML::link('#', 'Zurück', array('class' => 'btn btn-default', 'onClick="javascript:history.back();return false;"'))!!}
	@endif
@stop