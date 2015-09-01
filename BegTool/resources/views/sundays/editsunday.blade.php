@extends('layouts.main')

@section('content')
<h2>Dienste tauschen für den:  {!! date('d.m.Y',$sunday->sermons->date)!!}</h2>
{!! Form::model($sunday, array('url' => array('sundays/editsunday', $sunday->id))) !!}
{!! showMessageAndErrors(Session::get('message'), $errors->all()) !!}

   
    

    {!! Form::label('kigos_list', 'Kigo Leiter') !!}
    {!! Form::select('kigos_list', $kigos_list , [$sunday->kigos->user_id] ,array( 'class'=>'form-control', 'style'=> '')) !!}

    {!! Form::label('lection_number', 'Lektionsnummer') !!}
    {!! Form::text('lection_number', null , array('class'=>'form-control ', 'placeholder'=>'Nummer')) !!}

    {!! Form::label('lection', 'Lektion') !!}
    {!! Form::text('lection', null , array('class'=>'form-control ', 'placeholder'=>'Thema')) !!}

    {!! Form::label('lectors_list', 'Lektor') !!}
    {!! Form::select('lectors_list', $lectors_list, [$sunday->user_id] , array('class'=>'form-control', 'style'=> '')) !!}

    {!! Form::label('preachers_list', 'Prediger') !!}
    {!! Form::select('preachers_list', $preachers_list, [$sunday->sermons->preacher_id] , array('class'=>'form-control', 'style'=> '')) !!}    

    {!! Form::submit('Speichern', array('class'=>'btn btn-large save-button'))!!}
    {!! Form::close() !!}





@stop