@extends('layouts.main')

@section('content')
{!! Form::model($user, array('url' => array('users/edit', $user->id))) !!}
    <h2 class="form-signup-heading">Student bearbeiten</h2>
     {!! showMessageAndErrors(Session::get('message'), $errors->all()) !!}
 
    {!! Form::label('firstname', 'Vorname') !!}
    {!! Form::text('firstname', null, array('class'=>'form-control', 'placeholder'=>'Vorname')) !!}
    {!! Form::label('lastname', 'Nachname') !!}
    {!! Form::text('lastname', null, array('class'=>'form-control', 'placeholder'=>'Nachname')) !!}
    {!! Form::label('birthdate', 'Geburtsdatum') !!}
    <div class="input-group date datetimepicker"  data-date-format="YYYY-MM-DD">
    {!! Form::text('birthdate', null, array('class'=>'form-control', 'placeholder'=>'Datum')) !!}          
        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
    </div>
 <!--   {!! Form::label('email', 'E-Mail') !!}
    {!! Form::text('email', null, array('class'=>'form-control', 'placeholder'=>'E-Mail')) !!}
     {!! Form::label('username', 'Benutzername') !!}
     {!! Form::text('username', null, array('class'=>'form-control', 'placeholder'=>'Benutzername')) !!}
    {!! Form::label('password', 'Passwort') !!}
    {!! Form::password('password', array('class'=>'form-control', 'placeholder'=>'Passwort')) !!}
    {!! Form::label('password_confirmation', 'Passwort wiederholen') !!}
    {!! Form::password('password_confirmation', array('class'=>'form-control', 'placeholder'=>'Passwort wiederholen')) !!}
    <br/>-->
    {!! Form::submit('Ändern', array('class'=>'btn btn-large btn-primary btn-block'))!!}
{!! Form::close() !!}
<br/>
{!! HTML::link('#', 'Zurück', array('class' => 'btn btn-default', 'onClick="javascript:history.back();return false;"'))!!}
@stop
