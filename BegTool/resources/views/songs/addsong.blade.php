@extends('layouts.main')

@section('content')
		{!! Form::open(array('url'=>'songs/addsong', 'class'=>'form-signup')) !!}
        <h2 class="form-signup-heading">Lied anlegen</h2>
        {!! showMessageAndErrors(Session::get('message'), $errors->all()) !!}
        {!! Form::label('number', 'Nummer') !!}
    	{!! Form::text('number', null, array('class'=>'form-control', 'placeholder'=>'Feld darf leer bleiben')) !!}    		
		{!! Form::label('name', 'Name') !!}
		{!! Form::text('name', null, array('class'=>'form-control', 'placeholder'=>'Name')) !!}
    	{!! Form::label('annotation', 'Bemerkung') !!}
    	{!! Form::textarea('annotation', null, array('class'=>'form-control', 'row'=>'3', 'placeholder'=>'Bemerkung')) !!}    
		{!! Form::submit('Speichern', array('class'=>'btn btn-large btn-primary btn-block'))!!}
		{!! Form::close() !!}
@stop