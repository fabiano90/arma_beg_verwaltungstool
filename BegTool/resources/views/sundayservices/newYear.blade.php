@extends('layouts.main') @section('content')
<h2>Registrierung</h2>
{!!Form::open(array('url'=>'sundayservices/newyear', 'class'=>'form-signup'))!!}
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
			<td>{!! Form::text('sunday'.$sunday, date('d.m.Y', $sunday), array('class'=>'form-control btn-link', 'disabled'=>'disabled')) !!}</td>
			<td> {!! Form::select('kigo'.$sunday, array('L' => 'Large', 'S' => 'Small'))!!}</td>
			<td>{!! Form::text('lektion'.$sunday, null , array('class'=>'form-control ', 'placeholder'=>'Lektion')) !!}</td>
			<td>{!! Form::text('topic'.$sunday, null , array('class'=>'form-control ', 'placeholder'=>'Thema')) !!}</td>
		
			<td> {!! Form::select('user_id'.$sunday, array(
				@foreach($users as$user)
				$user => $user ,
				@endforeach
			))!!}</td>
			
			<td> {!! Form::select('preacher_id'.$sunday, array('L' => 'Large', 'S' => 'Small'), array('class'=>'form-control'))!!}</td>

		</tr>
		@endforeach
	
	</tbody>
</table>
{!! Form::submit('Speichern', array('class'=>'btn btn-large btn-primary
btn-block'))!!} {!! Form::close() !!} @stop
