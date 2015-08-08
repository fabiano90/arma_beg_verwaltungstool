@extends('layouts.main')

@section('content')

{!! Form::model($sunday, array('url' => array('sundayservices/editservice', $sunday->id))) !!}
{!! showMessageAndErrors(Session::get('message'), $errors->all()) !!}

    <h2 class="form-signup-heading">Gottesdienst bearbeiten für den:  {!! $sunday->sermons->date!!}</h2>

    {!! Form::label('psalm', 'Nummer') !!}
    {!! Form::text('psalm', null, array('class'=>'form-control', 'placeholder'=>'Nummer')) !!}    
    {!! Form::label('biblereading', 'Thema') !!}
    {!! Form::text('biblereading', null, array('class'=>'form-control', 'placeholder'=>'Thema')) !!}
    {!! Form::label('comments', 'Leitgedanke & Anwendung') !!}
    {!! Form::textarea('comments', null, array('class'=>'form-control', 'row'=>'2', 'placeholder'=>'Leitgedanke & Anwendung')) !!}
    {!! Form::label('sacrament', 'Material') !!}
    {!! Form::textarea('sacrament', null, array('class'=>'form-control', 'row'=>'2', 'placeholder'=>'Material')) !!}

    @if($sunday->songs != '[]')
        {!! Form::label('songs', 'Lieder') !!}
    @endif
    <ul>
        @foreach($sunday->songs as $song)
            <li>{!! $song->name !!}</li>
        @endforeach
    </ul>

    {!! Form::submit('weiter', array('class'=>'btn btn-large btn-primary btn-block'))!!}
    {!! Form::close() !!}

    {!! HTML::link('#', 'Zurück', array('class' => 'btn btn-default', 'onClick="javascript:history.back();return false;"'))!!}
@stop