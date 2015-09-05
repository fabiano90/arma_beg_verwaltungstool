@extends('layouts.main')
@section('messages') 
    @if($newMessages>'0')
    <span class="label label-danger message-cound">
        {!!$newMessages." neu"!!}</span> 
    @endif 
@stop

@section('menu')
    <ul class="nav nav-tabs">
        <li role="presentation" ><a href='/songs'><span class="glyphicon glyphicon-music" aria-hidden="true"></span></a></li>
    </ul>
@stop

@section('content')
<section class="section content-shadow content-box">
		{!! Form::open(array('url'=>'songs/addsong', 'class'=>'form-signup')) !!}
        <h2 class="form-signup-heading">Lied anlegen</h2>        
        {!! Form::label('number', 'Nummer') !!}
    	{!! Form::text('number', null, array('class'=>'form-control', 'placeholder'=>'Feld darf leer bleiben')) !!}    		
		{!! Form::label('name', 'Name') !!}
		{!! Form::text('name', null, array('class'=>'form-control', 'placeholder'=>'Name')) !!}
    	{!! Form::label('annotation', 'Bemerkung') !!}
    	{!! Form::textarea('annotation', null, array('class'=>'form-control', 'row'=>'3', 'placeholder'=>'Bemerkung')) !!}    
		{!! Form::submit('Speichern', array('class'=>'btn btn-large btn-primary btn-block'))!!}
		{!! Form::close() !!}
</section>
@stop