@extends('layouts.main')

@section('content')
	{!! Form::model($sermon, array('url' => array('sermons/editsermon', $sermon->id))) !!}
    <h2 class="form-signup-heading">Predigt vom {!! date('d.m.Y', $sermon->date) !!} bearbeiten</h2>
    {!! Form::label('scripture', 'Predigttext') !!}
	{!! Form::text('scripture', null, array('class'=>'form-control', 'placeholder'=>'Predigttext')) !!}    
	{!! Form::label('topic', 'Thema') !!}
	{!! Form::text('topic', null, array('class'=>'form-control', 'placeholder'=>'Thema')) !!}
	{!! Form::label('subitem', 'Unterpunkt') !!}
	{!! Form::text('subitem', null, array('class'=>'form-control', 'row'=>'2', 'placeholder'=>'Unterpunkt')) !!}
	{!! Form::label('series', 'Series') !!}
	{!! Form::text('series', null, array('class'=>'form-control', 'row'=>'2', 'placeholder'=>'Series')) !!}
	{!! Form::label('book', 'Buch') !!}
	{!! Form::text('book', null, array('class'=>'form-control', 'row'=>'2', 'placeholder'=>'Buch')) !!}
	{!! Form::label('occasion', 'Anlass') !!}
	{!! Form::text('occasion', null, array('class'=>'form-control', 'row'=>'2', 'placeholder'=>'Anlass')) !!}
	{!! Form::label('info_text', 'Infos an den Lektor') !!}
	{!! Form::text('info_text', null, array('class'=>'form-control', 'row'=>'2', 'placeholder'=>'Infos')) !!}
	{!! Form::label('link', 'MP3-Link') !!}
	{!! Form::text('link', null, array('class'=>'form-control', 'row'=>'2', 'placeholder'=>'MP3-Link')) !!}
	{!! Form::submit('Weiter', array('class'=>'btn btn-large btn-primary btn-block'))!!}
	{!! Form::close() !!}

@stop