@extends('layouts.main')

@section('content')

{!! Form::open(array('url'=>'sundayservice/newsunday', 'class'=>'form-signup')) !!}
    <h2 class="form-signup-heading">Neuen Gottesdienst anlegen</h2>
    
    {!! Form::label('kigoleader_id', 'Lektor_id') !!}
    {!! Form::text('kigoleader_id', null, array('class'=>'form-control', 'placeholder'=>'Vorname')) !!}
    {!! Form::label('preacher_id', 'Prediger_id') !!}
    {!! Form::text('preacher_id', null, array('class'=>'form-control', 'placeholder'=>'Nachname')) !!}
    {!! Form::label('lector_id', 'Lektor_id') !!}
    {!! Form::text('lector_id', null, array('class'=>'form-control', 'placeholder'=>'Nachname')) !!}

    {!! Form::label('birthdate', 'Geburtsdatum') !!}
    <div class="input-group date datetimepicker"  data-date-format="YYYY-MM-DD">
    {!! Form::text('birthdate', null, array('class'=>'form-control', 'placeholder'=>'Geburtsdatum')) !!}          
        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
    </div>
    <br/>
    {!! Form::submit('Speichern', array('class'=>'btn btn-large btn-primary btn-block'))!!}
{!! Form::close() !!}
<br/>
{!! HTML::link('#', 'Zurück', array('class' => 'btn btn-default', 'onClick="javascript:history.back();return false;"'))!!}


    


@stop