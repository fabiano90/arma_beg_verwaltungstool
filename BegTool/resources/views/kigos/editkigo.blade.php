@extends('layouts.main')

@section('content')
		{!! Form::model($kigo, array('url' => array('kigos/editkigo', $kigo->id))) !!}
        <h2 class="form-signup-heading">Kigo vom {!! $kigo->lection !!} bearbeiten</h2>
        {!! Form::label('lection_number', 'Nummer') !!}
    	{!! Form::text('lection_number', null, array('class'=>'form-control', 'placeholder'=>'Nummer')) !!}    
		{!! Form::label('lection', 'Thema') !!}
		{!! Form::text('lection', null, array('class'=>'form-control', 'placeholder'=>'Thema')) !!}
    	{!! Form::label('conclusion', 'Leitgedanke & Anwendung') !!}
    	{!! Form::textarea('conclusion', null, array('class'=>'form-control', 'row'=>'2', 'placeholder'=>'Leitgedanke & Anwendung')) !!}
    	{!! Form::label('material', 'Material') !!}
    	{!! Form::textarea('material', null, array('class'=>'form-control', 'row'=>'2', 'placeholder'=>'Material')) !!}
    	{!! Form::label('crafting', 'Basteln') !!}
    	{!! Form::textarea('crafting', null, array('class'=>'form-control', 'row'=>'2', 'placeholder'=>'Material')) !!}

		{!! Form::submit('Speichern', array('class'=>'btn btn-large btn-primary btn-block'))!!}
		{!! Form::close() !!}
@stop