@extends('layouts.main')

@section('content')
		{!! Form::open(array('url'=>'songs/addsong', 'class'=>'form-signup')) !!}
        <h2 class="form-signup-heading">Registrierung</h2>
		{!! Form::label('name', 'Vorname') !!}
		{!! Form::text('name', null, array('class'=>'form-control', 'placeholder'=>'Vorname')) !!}
    	{!! Form::label('annotation', 'Nachname') !!}
    	{!! Form::text('annotation', null, array('class'=>'form-control', 'placeholder'=>'Nachname')) !!}    

		{!! Form::submit('Speichern', array('class'=>'btn btn-large btn-primary btn-block'))!!}
		{!! Form::close() !!}
@stop