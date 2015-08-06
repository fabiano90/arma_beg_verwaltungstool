@extends('layouts.main')

@section('content')


@foreach($sundays as $sunday)
{!! Form::model($sunday, array('url' => array('sundayservices/editsunday', $sunday->id))) !!}
    <h2 class="form-signup-heading">Dienste für den {!! $sunday->date!!} tauschen</h2>


    </div>
    <br/>
    {!! Form::label('kigos_list', 'Kigo Leiter') !!}
    {!! Form::select('kigos_list', $kigos_list,[$sunday->kid] ,array( 'class'=>'form-control', 'style'=> '')) !!}
    <br/>
    {!! Form::label('lection_number', 'Lektionsnummer') !!}
    {!! Form::text('lection_number', null , array('class'=>'form-control ', 'placeholder'=>'Nummer')) !!}
    <br/>
    {!! Form::label('lection', 'Lektion') !!}
    {!! Form::text('lection', null , array('class'=>'form-control ', 'placeholder'=>'Thema')) !!}
    <br/>
    {!! Form::label('lectors_list', 'Lektor') !!}
    {!! Form::select('lectors_list', $lectors_list, [$sunday->lid] , array('class'=>'form-control', 'style'=> '')) !!}
    <br/>
    {!! Form::label('preachers_list', 'Prediger') !!}
    {!! Form::select('preachers_list', $preachers_list, [$sunday->pid] , array('class'=>'form-control', 'style'=> '')) !!}    
    <br/>
    {!! Form::submit('Speichern', array('class'=>'btn btn-large btn-primary btn-block'))!!}
{!! Form::close() !!}
<br/>
{!! HTML::link('#', 'Zurück', array('class' => 'btn btn-default', 'onClick="javascript:history.back();return false;"'))!!}


@endforeach 


@stop