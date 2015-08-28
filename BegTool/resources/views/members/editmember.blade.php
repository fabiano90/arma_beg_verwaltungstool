@extends('layouts.main')

@section('content')
	@if( !($auth_user->permission == 0 || $auth_user->member_id == $member->id) )
		<h2>Sie sind nicht berechtigt Mitglied {!! $member->firstname !!} {!! $member->lastname !!} zu bearbeiten</h2>
	@else
		{!! Form::model($member, array('url' => array('members/editmember', $member->id))) !!}
		{!! showMessageAndErrors(Session::get('message'), $errors->all()) !!}
		<h2 class="form-signup-heading">Mitglied {!! $member->firstname !!}{!! $member->lastname !!} bearbeiten</h2>
			
		{!! Form::label('firstname', 'Vorname') !!}
		{!! Form::text('firstname', null, array('id'=>'firstname', 'class'=>'form-control', 'placeholder'=>'Vorname')) !!}
		{!! Form::label('lastname', 'Nachname') !!}
		{!! Form::text('lastname', null, array('id'=>'lastname', 'class'=>'form-control', 'placeholder'=>'Vorname')) !!}
		{!! Form::label('onlinename', 'Onlinename') !!}
		{!! Form::text('onlinename', null, array('id'=>'onlinename', 'class'=>'form-control', 'placeholder'=>'Nachname')) !!}    
	    {!! Form::label('birthdate', 'Geburtsdatum') !!}
	    <div class="input-group date datetimepicker"  data-date-format="DD.MM.YYYY">
	    {!! Form::text('birthdate', date('d.m.Y', $member->birthdate), array('class'=>'form-control', 'placeholder'=>'Geburtsdatum JJJJ-MM-TT')) !!}
	        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span></div>
		{!! Form::submit('Speichern', array('class'=>'btn btn-large btn-primary btn-block'))!!}
		{!! Form::close() !!}
	@endif

@stop