@extends('layouts.main')

@section('content')

		{!! Form::open(array('url'=>'members/register', 'class'=>'form-signup')) !!}
		{!! showMessageAndErrors(Session::get('message'), $errors->all()) !!}
        <h2 class="form-signup-heading">Registrierung</h2>
		{!! Form::label('firstname', 'Vorname') !!}
		{!! Form::text('firstname', null, array('id'=>'firstname', 'class'=>'form-control', 'placeholder'=>'Vorname')) !!}
    	{!! Form::label('lastname', 'Nachname') !!}
    	{!! Form::text('lastname', null, array('id'=>'lastname', 'class'=>'form-control', 'placeholder'=>'Vorname')) !!}
    	{!! Form::label('onlinename', 'Onlinename') !!}
    	{!! Form::text('onlinename', null, array('id'=>'onlinename', 'class'=>'form-control', 'placeholder'=>'Nachname')) !!}    
        {!! Form::label('birthdate', 'Geburtsdatum') !!}
        <div class="input-group date datetimepicker"  data-date-format="DD.MM.YYYY">
        {!! Form::text('birthdate', null, array('class'=>'form-control', 'placeholder'=>'Geburtsdatum JJJJ-MM-TT')) !!}          
            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span></div>
		{!! Form::submit('Speichern', array('class'=>'btn btn-large btn-primary btn-block'))!!}
		{!! Form::close() !!}
@stop