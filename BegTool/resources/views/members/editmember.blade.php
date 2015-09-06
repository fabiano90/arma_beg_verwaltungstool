@extends('layouts.main')
@section('messages') 
    @if($newMessages>'0')
    <span class="label label-danger message-cound">
        {!!$newMessages." neu"!!}</span> 
    @endif 
@stop

@section('menu')
    <ul class="nav nav-tabs">
        <li role="presentation" ><a href='/members'><span class="glyphicon glyphicon-user" aria-hidden="true"></span></a></li>
    </ul>
@stop

@section('content')
<section class="section content-shadow content-box">
	@if( !($auth_user->permission == 0 || $auth_user->member_id == $member->id) )
		<h2>Sie sind nicht berechtigt Mitglied {!! $member->onlinename !!} zu bearbeiten</h2>
	@else
		{!! Form::model($member, array('url' => array('members/editmember', $member->id))) !!}		
		
		<h2 class="form-signup-heading">{!! $member->onlinename !!} bearbeiten</h2>
			
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
		{!! Form::label('email', 'E-Mail') !!}
	    {!! Form::text('email', null, array('class'=>'form-control', 'placeholder'=>'E-Mail')) !!}	        
		{!! Form::submit('Speichern', array('class'=>'btn btn-large btn-primary btn-block'))!!}
		{!! Form::close() !!}
	@endif
</section>

@stop