@extends('layouts.main')
@section('messages') 
    @if($newMessages>'0')
    <span class="label label-danger message-cound">
        {!!$newMessages." neu"!!}</span> 
    @endif 
@stop

@section('menu')
    <ul class="nav nav-tabs">
        <li role="presentation" ><a href='/sundays'><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span></a></li>
    </ul>
@stop

@section('content')
<section class="section content-shadow content-box">
    <h2>Dienste tauschen für den:  {!! date('d.m.Y',$sunday->sermons->date)!!}</h2>
    {!! Form::model($sunday, array('url' => array('/sundays/editsunday', $sunday->id))) !!}   

    {!! Form::label('kigos_list', 'Kigo Leiter') !!}
    {!! Form::select('kigos_list', $kigos_list , [$sunday->kigos->user_id] ,array( 'class'=>'form-control', 'style'=> '')) !!}

    {!! Form::label('lection_number', 'Lektionsnummer') !!}
    {!! Form::text('lection_number', $kigo->lection_number , array('class'=>'form-control ', 'placeholder'=>'Nummer')) !!}

    {!! Form::label('lection', 'Lektion') !!}
    {!! Form::text('lection', $kigo->lection , array('class'=>'form-control ', 'placeholder'=>'Thema')) !!}

    {!! Form::label('lectors_list', 'Lektor') !!}
    {!! Form::select('lectors_list', $lectors_list, [$sunday->user_id] , array('class'=>'form-control', 'style'=> '')) !!}

    {!! Form::label('preachers_list', 'Prediger') !!}
    {!! Form::select('preachers_list', $preachers_list, [$sunday->sermons->preacher_id] , array('class'=>'form-control', 'style'=> '')) !!}    

    {!! Form::submit('Speichern', array('class'=>'btn btn-large save-button'))!!}
    {!! Form::submit('Speichern', array('class'=>'btn btn-large btn-primary btn-block', 'id' => 'submitButton'))!!}
    {!! Form::close() !!}
</section>
@stop