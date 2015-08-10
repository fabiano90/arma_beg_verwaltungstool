@extends('layouts.main')

@section('content')
	{!!HTML::script('js/sermonsaddsubitem.js')!!}

	{!! Form::model($sermon, array('url' => array('sermons/editsermon', $sermon->id))) !!}
    <h2 class="form-signup-heading">Predigt vom {!! date('d.m.Y', $sermon->date) !!} bearbeiten</h2>
    {!! Form::label('scripture', 'Predigttext') !!}
	{!! Form::text('scripture', null, array('class'=>'form-control', 'placeholder'=>'Predigttext')) !!}    

	{!! Form::label('topic0', 'Thema') !!}
 	<div class="input-group">
      <span class="input-group-btn">
        <button id="addSubItem" class="btn btn-default" type="button"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Unterpunkt</button>
      </span>
      {!! Form::text('topic0', null, array('class'=>'form-control', 'placeholder'=>'Thema')) !!}
    </div>

	{!! Form::label('series', 'Series') !!}
	{!! Form::text('series', null, array('class'=>'form-control', 'placeholder'=>'Series')) !!}
	{!! Form::label('book', 'Buch') !!}
	{!! Form::text('book', null, array('class'=>'form-control', 'placeholder'=>'Buch')) !!}
	{!! Form::label('occasion', 'Anlass') !!}
	{!! Form::text('occasion', null, array('class'=>'form-control', 'placeholder'=>'Anlass')) !!}
	{!! Form::label('info_text', 'Infos an den Lektor') !!}
	{!! Form::text('info_text', null, array('class'=>'form-control', 'placeholder'=>'Infos')) !!}
	{!! Form::label('link', 'MP3-Link') !!}
	{!! Form::text('link', null, array('class'=>'form-control', 'placeholder'=>'MP3-Link')) !!}
	{!! Form::submit('Weiter', array('class'=>'btn btn-large btn-primary btn-block', 'id' => 'submitButton'))!!}
	{!! Form::close() !!}

@stop