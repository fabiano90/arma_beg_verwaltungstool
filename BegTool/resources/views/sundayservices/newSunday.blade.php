@extends('layouts.main')

@section('content')

{!! Form::open(array('url'=>'sundayservices/newsunday', 'class'=>'form-signup')) !!}
    <h2 class="form-signup-heading">Neuen Gottesdienst anlegen</h2>
    


    {!! Form::label('date', 'Sonntag') !!}
    <div class="input-group date datetimepicker"  data-date-format="YYYY-MM-DD">
    {!! Form::text('date', null, array('class'=>'form-control', 'placeholder'=>'Geburtsdatum')) !!}          
        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
    </div>
    {!! Form::label('kigos_list', 'Kigo Leiter') !!}
    {!! Form::select('kigos_list', $kigos_list, null, array('class'=>'form-control', 'style'=> '')) !!}
    {!! Form::label('preachers_list', 'Prediger') !!}
    {!! Form::select('preachers_list', $preachers_list, null, array('class'=>'form-control', 'style'=> '')) !!}
    {!! Form::label('lectors_list', 'Lektor') !!}
    {!! Form::select('lectors_list', $lectors_list, null, array('class'=>'form-control', 'style'=> '')) !!}
    <br/>
    {!! Form::submit('Speichern', array('class'=>'btn btn-large btn-primary btn-block'))!!}
{!! Form::close() !!}
<br/>
{!! HTML::link('#', 'Zurück', array('class' => 'btn btn-default', 'onClick="javascript:history.back();return false;"'))!!}


    


@stop