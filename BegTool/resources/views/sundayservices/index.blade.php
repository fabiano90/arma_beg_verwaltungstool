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
			@foreach($sundayservices as $sundayservice)
			<tr>				
				<td data-type="numeric" data-value='{!! strtotime($sundayservice->sermons->date)!!}'>{!! $sundayservice->sermons->date !!}</td>
				<td>{!! $sundayservice->kigos->users->username !!}</td>
				<td>{!! $sundayservice->kigos->lection_number !!}</td>
				<td>{!! $sundayservice->kigos->lection !!}</td>
				<td>{!! $sundayservice->users->username !!}</td>
				<td>{!! $sundayservice->sermons->members->onlinename !!}</td>
				<td><a href="sundayservices/editsunday/{!! $sundayservice->id!!}"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a></td>

			</tr>
			@endforeach
		</tbody>
	</table>	
</div>
@stop
