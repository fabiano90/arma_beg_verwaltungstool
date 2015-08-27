@extends('layouts.main')

@section('content')

{!! Form::model($sunday, array('url' => array('sundays/editsunday', $sunday->id))) !!}
{!! showMessageAndErrors(Session::get('message'), $errors->all()) !!}

    <h2 class="form-signup-heading">Dienste tasuchen für den:  {!! $sunday->sermons->date!!}</h2>
    

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

    {!! Form::submit('Speichern', array('class'=>'btn btn-large btn-primary btn-block'))!!}
    {!! Form::close() !!}

    {!! HTML::link('#', 'Zurück', array('class' => 'btn btn-default', 'onClick="javascript:history.back();return false;"'))!!}



@stop