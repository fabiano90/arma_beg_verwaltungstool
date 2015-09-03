@extends('layouts.main')

@section('content')
		{!! Form::model($song, array('url' => array('songs/editsong', $song->id))) !!}
        <h2 class="form-signup-heading">Lied {!! $song->name !!} bearbeiten</h2>        
        {!! Form::label('number', 'Nummer') !!}
    	{!! Form::text('number', null, array('class'=>'form-control', 'placeholder'=>'Feld darf leer bleiben')) !!}    
		{!! Form::label('name', 'Name') !!}
		{!! Form::text('name', null, array('class'=>'form-control', 'placeholder'=>'Name')) !!}
    	{!! Form::label('annotation', 'Bemerkung') !!}
    	{!! Form::textarea('annotation', null, array('class'=>'form-control', 'row'=>'3', 'placeholder'=>'Bemerkung')) !!}
		{!! Form::submit('Speichern', array('class'=>'btn btn-large btn-primary btn-block'))!!}
		{!! Form::close() !!}
@stop