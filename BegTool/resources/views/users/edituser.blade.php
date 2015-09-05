@extends('layouts.main')
@section('menu')
    <ul class="nav nav-tabs">
        <li role="presentation" ><a href='/members'><span class="glyphicon glyphicon-user" aria-hidden="true"></span></a></li>
    </ul>
@stop

@section('content')
<section class="section content-shadow content-box">
	@if( !($auth_user->permission == 0 || $auth_user->id == $user->id) )
		<h2>Sie sind nicht berechtigt Mitarbeiter {!! $user->username !!} ({!! $member->firstname!!} {!! $member->lastname!!}) zu bearbeiten</h2>
		{!! HTML::link('#', 'Zurück', array('class' => 'btn btn-default', 'onClick="javascript:history.back();return false;"'))!!}
	@else
    	<h2>{!! $user->username !!} bearbeiten</h2>

		{!! Form::open(array('url'=>'users/edituser/'.$user->id, 'class'=>'form-signup')) !!}		

		{!! Form::label('firstname', 'Vorname') !!}
		{!! Form::text('firstname', $member->firstname, array('class'=>'form-control ', 'placeholder'=>'Nachname')) !!}
    	{!! Form::label('lastname', 'Nachname') !!}
    	{!! Form::text('lastname', $member->lastname, array('class'=>'form-control ', 'placeholder'=>'Nachname')) !!}
    	{!! Form::label('onlinename', 'Onlinename') !!}
    	{!! Form::text('onlinename', $member->onlinename, array('class'=>'form-control ', 'placeholder'=>'Onlinename')) !!}
	    {!! Form::label('birthdate', 'Geburtsdatum') !!}
	    {!! Form::text('birthdate', date('d.m.Y', $member->birthdate), array('class'=>'form-control ', 'placeholder'=>'Nachname')) !!}      

    	{!! Form::label('username', 'Benutzername') !!}
   	 	{!! Form::text('username', $member->firstname, array('class'=>'form-control', 'placeholder'=>'Benutzername')) !!}

		{!! Form::label('email', 'E-Mail') !!}
	    {!! Form::text('email', $user->email, array('class'=>'form-control', 'placeholder'=>'E-Mail')) !!}

	    @if($auth_user->permission == 0 && $auth_user->id != $user->id)
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
		@endif

		{!! Form::submit('Speichern', array('class'=>'btn btn-large btn-primary btn-block'))!!}
		{!! Form::close() !!}
		
	@endif
</section>
@stop