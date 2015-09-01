@extends('layouts.main')
@section('menu')
    <ul class="nav nav-tabs">
        <li role="presentation"class="active" ><a href='/sundays/newsunday'><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Gottesdienst</a></li>
        <li role="presentation"><a href='{!! '/sundays/newyear/'.date('Y')!!}'><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> {!!' Jahr '.date('Y')!!}</a></li>
        <li role="presentation"><a href='{!! '/sundays/newyear/'.date("Y", strtotime(date("Y", strtotime(date("Y"))) . " + 1 year"))!!}'><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>{!!'Jahr '.date("Y", strtotime(date("Y", strtotime(date("Y"))) . " + 1 year"))!!}</a></li>
        <li role="presentation"><a href='{!!'/sundays/edityear/'.date('Y')!!}'><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>{!!' Jahr '. date('Y')!!}</a></li>
        <li role="presentation"><a href='{!! '/sundays/edityear/'.date("Y", strtotime(date("Y", strtotime(date("Y"))) . " + 1 year"))!!}'><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>{!!' Jahr '. date("Y", strtotime(date("Y", strtotime(date("Y"))) . " + 1 year"))!!}</a></li>
    </ul>
@stop

@section('content')
<section class="section content-shadow content-box">
<h2>Neuen Gottesdienst anlegen</h2>
{!! Form::open(array('url'=>'sundays/newsunday', 'class'=>'form-signup')) !!}

    {!! Form::label('date', 'Sonntag') !!}
    <div class="input-group date datetimepicker"  data-date-format="DD.MM.YYYY">
    {!! Form::text('date', null, array('class'=>'form-control', 'placeholder'=>'Datum')) !!}          
        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
    </div>
 
    {!! Form::label('kigos_list', 'Kigo Leiter') !!}
    {!! Form::select('kigos_list', $kigos_list, null, array('class'=>'form-control', 'style'=> '')) !!}
  
    {!! Form::label('lection_number', 'Lektionsnummer') !!}
    {!! Form::text('lection_number', null , array('class'=>'form-control ', 'placeholder'=>'Nummer')) !!}
  
    {!! Form::label('lection', 'Lektion') !!}
    {!! Form::text('lection', null , array('class'=>'form-control ', 'placeholder'=>'Thema')) !!}
    
    {!! Form::label('preachers_list', 'Prediger') !!}
    {!! Form::select('preachers_list', $preachers_list, null, array('class'=>'form-control', 'style'=> '')) !!}
    
    {!! Form::label('lectors_list', 'Lektor') !!}
    {!! Form::select('lectors_list', $lectors_list, null, array('class'=>'form-control', 'style'=> '')) !!}
  
    {!! Form::submit('Speichern', array('class'=>'btn btn-large save-button'))!!}
{!! Form::close() !!}
<br/>
</section>


    


@stop