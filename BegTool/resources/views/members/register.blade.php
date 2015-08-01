@extends('layouts.main')

@section('content')
    <h2>Registrierung</h2>
		{!! Form::open(array('url'=>'members/register', 'class'=>'form-signup')) !!}
        <h2 class="form-signup-heading">Student hinzufügen</h2>
		{!! Form::label('firstname', 'Vorname') !!}
		{!! Form::text('firstname', null, array('class'=>'form-control', 'placeholder'=>'Vorname')) !!}
    	{!! Form::label('lastname', 'Nachname') !!}
    	{!! Form::text('lastname', null, array('class'=>'form-control', 'placeholder'=>'Nachname')) !!}    
        {!! Form::label('birthdate', 'Geburtsdatum') !!}
        <div class="input-group date datetimepicker"  data-date-format="YYYY-MM-DD">
        {!! Form::text('birthdate', null, array('class'=>'form-control', 'placeholder'=>'Geburtsdatum JJJJ-MM-TT')) !!}          
            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span></div>
		{!! Form::submit('Speichern', array('class'=>'btn btn-large btn-primary btn-block'))!!}
		{!! Form::close() !!}
@stop