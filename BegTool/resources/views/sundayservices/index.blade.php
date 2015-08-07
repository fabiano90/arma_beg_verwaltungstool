@extends('layouts.main') @section('content')

<h2>Kalender</h2>
<p>
	{!! HTML::link('sundayservices/newsunday', 'Hinzuf&uuml;gen', array('class' => 'btn btn-default'))!!}
</p>
<div class="table-responsive">
<input id="filter" class="form-control" type="text" placeholder="Suche">
	<table class="table table-striped table-hover footable" data-filter="#filter">
		<thead>
			<tr>
				<th data-sort-initial="true">Sonntag</th>
				<th>Kigo</th>
				<th data-hide="phone">Nr.</th>
				<th data-hide="phone">Lektion</th>
				<th>Lektor</th>
				<th>Prediger</th>
				<th></th>
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
				<td><a href="sundayservices/editsunday/{!! $kalender->id!!}"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a></td>
			</tr>
			@endforeach
		</tbody>
	</table>	
</div>
@stop
