@extends('layouts.main') @section('content')

{!!Form::open(array('url'=>'sundays/newyear', 'class'=>'form-signup'))!!}

<h2>Jahresplanung{!! Form::text('year', $year, array('class'=>'form-control ', 'placeholder'=>'Nachname')) !!}</h2>
{!! showMessageAndErrors(Session::get('message'), $errors->all()) !!}
<table class="table table-striped table-hover">
	<tbody>
		<tr>
			<th>Sonntag</th>
			<th>Kigo</th>
			<th>Lektion</th>
			<th>Thema</th>
			<th>Lektor</th>
			<th>Prediger</th>
		</tr>
		@foreach($sundays as$sunday)
	
		
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
{!! Form::submit('Speichern', array('class'=>'btn btn-large btn-primary
btn-block'))!!} {!! Form::close() !!} @stop
