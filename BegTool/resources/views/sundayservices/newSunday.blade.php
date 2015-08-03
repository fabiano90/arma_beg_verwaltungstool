@extends('layouts.main')

@section('content')

{!! Form::open(array('url'=>'sundayservices/newsunday', 'class'=>'form-signup')) !!}
    <h2 class="form-signup-heading">Neuen Gottesdienst anlegen</h2>
    


    {!! Form::label('date', 'Sonntag') !!}
    <div class="input-group date datetimepicker"  data-date-format="YYYY-MM-DD">
    {!! Form::text('date', null, array('class'=>'form-control', 'placeholder'=>'Geburtsdatum')) !!}          
        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
    </div>
    {!! Form::label('kigoleader', 'Kigo Leiter') !!}
    {!! Form::text('kigoleader', null, array('class'=>'form-control', 'placeholder'=>'Username')) !!}
    {!! Form::label('preacher', 'Prediger (Vorname Nachname') !!}
    {!! Form::text('preacher', null, array('class'=>'form-control', 'placeholder'=>'Username')) !!}
    {!! Form::label('lector', 'Lektor') !!}
    {!! Form::text('lector', null, array('class'=>'form-control', 'placeholder'=>'Username')) !!}
    <br/>
    {!! Form::submit('Speichern', array('class'=>'btn btn-large btn-primary btn-block'))!!}
{!! Form::close() !!}
<br/>
{!! HTML::link('#', 'Zurück', array('class' => 'btn btn-default', 'onClick="javascript:history.back();return false;"'))!!}


    


@stop