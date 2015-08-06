@extends('layouts.main') @section('content')

<h2>Kalender</h2>
<p>
	{!! HTML::link('sundayservices/newsunday', 'Hinzuf&uuml;gen', array('class' => 'btn btn-default'))!!}
</p>
<div  class="table-responsive">
	<table id="leitung" class="table table-striped table-hover footable toggle-medium">
		<thead>
			<tr>
				<th>Sonntag</th>
				<th>Kigoleitung</th>
				<th data-hidden="phone">Lektion</th>
				<th data-hidden="phone">Thema</th>
				<th>Lektor</th>
				<th>Prediger</th>
			</tr>
		</thead>

		<tbody>
			@foreach($kalenders as $kalender)
			<tr>				
				<td data-type="numeric" data-value='{!! strtotime($kalender->date)!!}'>{!! $kalender->date !!}</td>
				<td>{!! $kalender->kigo_name !!}</td>
				<td>{!! $kalender->lection_number !!}</td>
				<td>{!! $kalender->lection !!}</td>
				<td>{!! $kalender->lector_name !!}</td>
				<td>{!! $kalender->onlinename !!}</td>
			</tr>
			@endforeach
		</tbody>
	</table>	
</div>
@stop
