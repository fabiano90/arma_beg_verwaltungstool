@extends('layouts.main')

@section('content')
{!! Form::model($grade, array('url' => array('grades/edit', $grade->id))) !!}
    <h2 class="form-signup-heading">Note bearbeiten</h2>
     {!! showMessageAndErrors(Session::get('message'), $errors->all()) !!}
 
    {!! Form::label('user_id', 'Student') !!}
    {!! Form::select('user_id', $users, null, array('class'=>'form-control')) !!}
    {!! Form::label('course_id', 'Kurs') !!}
    {!! Form::select('course_id', $courses, null, array('class'=>'form-control')) !!}
    {!! Form::label('grade', 'Note') !!}
    {!! Form::select('grade', $grades, null, array('class'=>'form-control', 'placeholder'=>'Note')) !!}
    <br/>
    {!! Form::submit('Ändern', array('class'=>'btn btn-large btn-primary btn-block'))!!}
{!! Form::close() !!}
<br/>
{!! HTML::link('#', 'Zurück', array('class' => 'btn btn-default', 'onClick="javascript:history.back();return false;"'))!!}
@stop
