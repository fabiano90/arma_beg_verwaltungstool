@extends('layouts.main') 
@section('title')
{!!' Jahresplanung '.$year!!}
@stop
@section('menu')
	<li role="presentation" ><a href='/public/sundays/newsunday'><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Gottesdienst</a></li>
	@if($year == date('Y'))
		<li role="presentation"class="active"><a href='{!! '/public/sundays/newyear/'.date('Y')!!}'><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> {!!' Jahr '.date('Y')!!}</a></li>
		<li role="presentation"><a href='{!! '/public/sundays/newyear/'.date("Y", strtotime(date("Y", strtotime(date("Y"))) . " + 1 year"))!!}'><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>{!!'Jahr '.date("Y", strtotime(date("Y", strtotime(date("Y"))) . " + 1 year"))!!}</a></li>
	@else
		<li role="presentation"><a href='{!! '/public/sundays/newyear/'.date('Y')!!}'><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> {!!' Jahr '.date('Y')!!}</a></li>
		<li role="presentation"class="active"><a href='{!! '/public/sundays/newyear/'.date("Y", strtotime(date("Y", strtotime(date("Y"))) . " + 1 year"))!!}'><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>{!!'Jahr '.date("Y", strtotime(date("Y", strtotime(date("Y"))) . " + 1 year"))!!}</a></li>
	@endif
	<li role="presentation"><a href='{!!'/public/sundays/edityear/'.date('Y')!!}'><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>{!!' Jahr '. date('Y')!!}</a></li>
	<li role="presentation"><a href='{!! '/public/sundays/edityear/'.date("Y", strtotime(date("Y", strtotime(date("Y"))) . " + 1 year"))!!}'><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>{!!' Jahr '. date("Y", strtotime(date("Y", strtotime(date("Y"))) . " + 1 year"))!!}</a></li>

  	

@stop
@section('content')

{!!Form::open(array('url'=>'sundays/newyear', 'class'=>'form-signup'))!!}

{!! showMessageAndErrors(Session::get('message'), $errors->all()) !!}
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
			<td data-type="numeric" data-value= '$sunday'> {!! Form::text('date'.$sunday, date('d.m.Y', $sunday), array('class'=>'form-control btn-link')) !!}</td>
			
			<td> {!! Form::select('kigos_list'.$sunday, $kigos_list, null, array('class'=>'form-control', 'style'=> '')) !!}</td>
			
			
			<td> {!! Form::text('lection_number'.$sunday, null , array('class'=>'form-control ', 'placeholder'=>'Lektion')) !!}</td>
			<td> {!! Form::text('lection'.$sunday, null , array('class'=>'form-control ', 'placeholder'=>'Thema')) !!}</td>

			<td> {!! Form::select('preachers_list'.$sunday, $preachers_list, null, array('class'=>'form-control', 'style'=> '')) !!}</td>
			<td> {!! Form::select('lectors_list'.$sunday, $lectors_list, null, array('class'=>'form-control', 'style'=> '')) !!}</td>
			
		
		</tr>
		@endforeach
	
	</tbody>
</table>
<div class = 'hidden'>
{!! Form::text('year', $year, array('class'=>'form-control ', 'placeholder'=>'Nachname')) !!}
</div>
{!! Form::submit('Speichern', array('class'=>'btn btn-large btn-primary
btn-block'))!!} {!! Form::close() !!} @stop
