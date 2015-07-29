@extends('layouts.main')

@section('content')
{!! Form::open(array('url'=>'grades/new', 'class'=>'form-signup')) !!}
    <h2 class="form-signup-heading">Note hinzufügen</h2>
     {!! showMessageAndErrors(Session::get('message'), $errors->all()) !!}
 
    {!! Form::label('user_id', 'Student') !!}
    {!! Form::select('user_id', $users, '0', array('class'=>'form-control')) !!}
    {!! Form::label('course_id', 'Kurs') !!}
    {!! Form::select('course_id', $courses, '0', array('class'=>'form-control')) !!}
    {!! Form::label('grade', 'Note') !!}
    {!! Form::select('grade', $grades, '0', array('class'=>'form-control', 'placeholder'=>'Note')) !!}
    <br/>
    {!! Form::submit('Speichern', array('class'=>'btn btn-large btn-primary btn-block'))!!}
{!! Form::close() !!}
<br/>
{!! HTML::link('#', 'Zurück', array('class' => 'btn btn-default', 'onClick="javascript:history.back();return false;"'))!!}
@stop