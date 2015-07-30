@extends('layouts.main')

@section('content')
{!! Form::open(array('url'=>'login/login', 'class'=>'form-signin')) !!}
    <h2 class="form-signin-heading">Anmeldung</h2>
    {!! Form::label('username', 'Benutzername') !!}
    {!! Form::text('username', null, array('class'=>'form-control', 'placeholder'=>'Benutzername')) !!}
    {!! Form::label('password', 'Passwort') !!}
    {!! Form::password('password', array('class'=>'form-control', 'placeholder'=>'Passwort')) !!}
 	<br/>
    {!! Form::submit('Anmelden', array('class'=>'btn btn-large btn-primary btn-block'))!!}
{!! Form::close() !!}
@stop