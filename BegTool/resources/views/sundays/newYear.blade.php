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
		<li role="presentation" ><a href='/sundays/newsunday'><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Gottesdienst</a></li>
		@if($year == date('Y'))
			<li role="presentation"class="active"><a href='{!! '/sundays/newyear/'.date('Y')!!}'><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> {!!' Jahr '.date('Y')!!}</a></li>
			<li role="presentation"><a href='{!! '/sundays/newyear/'.date("Y", strtotime(date("Y", strtotime(date("Y"))) . " + 1 year"))!!}'><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>{!!'Jahr '.date("Y", strtotime(date("Y", strtotime(date("Y"))) . " + 1 year"))!!}</a></li>
		@else
			<li role="presentation"><a href='{!! '/sundays/newyear/'.date('Y')!!}'><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> {!!' Jahr '.date('Y')!!}</a></li>
			<li role="presentation"class="active"><a href='{!! '/sundays/newyear/'.date("Y", strtotime(date("Y", strtotime(date("Y"))) . " + 1 year"))!!}'><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>{!!'Jahr '.date("Y", strtotime(date("Y", strtotime(date("Y"))) . " + 1 year"))!!}</a></li>
		@endif
		<li role="presentation"><a href='{!!'/sundays/edityear/'.date('Y')!!}'><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>{!!' Jahr '. date('Y')!!}</a></li>
		<li role="presentation"><a href='{!! '/sundays/edityear/'.date("Y", strtotime(date("Y", strtotime(date("Y"))) . " + 1 year"))!!}'><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>{!!' Jahr '. date("Y", strtotime(date("Y", strtotime(date("Y"))) . " + 1 year"))!!}</a></li>
	</ul>
@stop
@section('content')
<section class="section content-shadow content-box">

<h2>{!!' Jahresplanung '.$year!!}</h2>
{!!Form::open(array('url'=>'/sundays/newyear', 'class'=>'form-signup'))!!}
  <div class="tablefixed">
<table class="table table-striped table-hover footable toggle-default" data-filter="#filter">
	<thead>
		<tr>
			<th data-sort-ignore="true">Sonntag</th>
			<th data-sort-ignore="true">Kigo</th>
			<th data-sort-ignore="true">Lektion</th>
			<th data-sort-ignore="true">Thema</th>
			<th data-sort-ignore="true">Lektor</th>
			<th data-sort-ignore="true">Prediger</th>
		</tr>
		
	</thead>
	<tbody>	@foreach($sundays as$sunday)
		<tr>
			<td> {!! Form::text('date'.$sunday, date('d.m.Y', $sunday), array('class'=>'form-control btn-link')) !!}</td>
			
			<td> {!! Form::select('kigos_list'.$sunday, $kigos_list, null, array('class'=>'form-control', 'style'=> '')) !!}</td>
			
			
			<td> {!! Form::text('lection_number'.$sunday, null , array('class'=>'form-control ', 'placeholder'=>'Lektion')) !!}</td>
			<td> {!! Form::text('lection'.$sunday, null , array('class'=>'form-control ', 'placeholder'=>'Thema')) !!}</td>

			<td> {!! Form::select('preachers_list'.$sunday, $preachers_list, null, array('class'=>'form-control', 'style'=> '')) !!}</td>
			<td> {!! Form::select('lectors_list'.$sunday, $lectors_list, null, array('class'=>'form-control', 'style'=> '')) !!}</td>
			
		
		</tr>
		@endforeach
	
	</tbody>
</table>
</div>
<div class = 'hidden'>
{!! Form::text('year', $year, array('class'=>'form-control ', 'placeholder'=>'Nachname')) !!}
</div> {!! Form::submit('Speichern', array('class'=>'btn btn-large btn-primary btn-block', 'id' => 'submitButton'))!!}
{!! Form::submit('Speichern', array('class'=>'btn btn-large save-button'))!!}
 {!! Form::close() !!}</section> @stop
