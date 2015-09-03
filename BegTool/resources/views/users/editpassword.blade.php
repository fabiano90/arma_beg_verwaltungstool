@extends('layouts.main')

@section('content')
	@if( !($auth_user->permission == 0 || $auth_user->id == $user->id) )
		<h2>Sie sind nicht berechtigt das Passwort von Mitarbeiter 
			{!! $user->username !!} ({!! $member->firstname!!} {!! $member->lastname!!}) zu ändern</h2>
		{!! HTML::link('#', 'Zurück', array('class' => 'btn btn-default', 'onClick="javascript:history.back();return false;"'))!!}
	@else
    	<h2>Passwort ändern von Mitarbeiter {!! $user->username !!} ({!! $member->firstname!!} {!! $member->lastname!!}) bearbeiten</h2>

		{!! Form::open(array('url'=>'users/editpassword/'.$user->id, 'class'=>'form-signup')) !!}		

		{!! Form::label('password', 'Passwort') !!}
	    {!! Form::password('password', array('class'=>'form-control', 'placeholder'=>'')) !!}
	    {!! Form::label('password_confirmation', 'Passwort wiederholen') !!}
	    {!! Form::password('password_confirmation', array('class'=>'form-control', 'placeholder'=>'Passwort wiederholen')) !!}


		{!! Form::submit('Speichern', array('class'=>'btn btn-large btn-primary btn-block'))!!}
		{!! Form::close() !!}
	@endif
@stop