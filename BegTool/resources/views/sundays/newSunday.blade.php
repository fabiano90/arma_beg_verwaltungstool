@extends('layouts.main')

@section('content')

{!! Form::open(array('url'=>'sundays/newsunday', 'class'=>'form-signup')) !!}
    <h2 class="form-signup-heading">Neuen Gottesdienst anlegen</h2>
    {!! showMessageAndErrors(Session::get('message'), $errors->all()) !!}


    {!! Form::label('date', 'Sonntag') !!}
    <div class="input-group date datetimepicker"  data-date-format="DD.MM.YYYY">
    {!! Form::text('date', null, array('class'=>'form-control', 'placeholder'=>'Datum')) !!}          
        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
    </div>
    <br/>
    {!! Form::label('kigos_list', 'Kigo Leiter') !!}
    {!! Form::select('kigos_list', $kigos_list, null, array('class'=>'form-control', 'style'=> '')) !!}
    <br/>
    {!! Form::label('lection_number', 'Lektionsnummer') !!}
    {!! Form::text('lection_number', null , array('class'=>'form-control ', 'placeholder'=>'Nummer')) !!}
    <br/>
    {!! Form::label('lection', 'Lektion') !!}
    {!! Form::text('lection', null , array('class'=>'form-control ', 'placeholder'=>'Thema')) !!}
    <br/>
    {!! Form::label('preachers_list', 'Prediger') !!}
    {!! Form::select('preachers_list', $preachers_list, null, array('class'=>'form-control', 'style'=> '')) !!}
    <br/>
    {!! Form::label('lectors_list', 'Lektor') !!}
    {!! Form::select('lectors_list', $lectors_list, null, array('class'=>'form-control', 'style'=> '')) !!}
    <br/>
    {!! Form::submit('Speichern', array('class'=>'btn btn-large btn-primary btn-block'))!!}
{!! Form::close() !!}
<br/>
{!! HTML::link('#', 'Zurück', array('class' => 'btn btn-default', 'onClick="javascript:history.back();return false;"'))!!}


    


@stop