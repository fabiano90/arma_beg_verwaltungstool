@extends('layouts.main') @section('content')

<h2>Kalender</h2>
<div class="btn-group">
	{!! HTML::link('sundayservices/newsunday',' Neuen Gottesdienst anlegen', array('class' => 'btn btn-default'))!!}
	{!! HTML::link('sundayservices/newyear/'.date('Y'),date('Y').' anlegen' , array('class' => 'btn btn-default'))!!}
	{!! HTML::link('sundayservices/newyear/'.date("Y", strtotime(date("Y", strtotime(date("Y"))) . " + 1 year")), date("Y", strtotime(date("Y", strtotime(date("Y"))) . " + 1 year")).'anlegen', array('class' => 'btn btn-default'))!!}

	{!! HTML::link('sundayservices/edityear/'.date('Y'),' Jahr '. date('Y'), array('class' => 'btn btn-default'))!!}
	{!! HTML::link('sundayservices/edityear/'.date("Y", strtotime(date("Y", strtotime(date("Y"))) . " + 1 year")),' Jahr '. date("Y", strtotime(date("Y", strtotime(date("Y"))) . " + 1 year")), array('class' => 'btn btn-default'))!!}
</div>

 	<a href='sundayservices/edityear/'.date('Y')><button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button></a>

 <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>

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
				<td data-type="numeric" data-value='{!! strtotime($sundayservice->sermons->date)!!}'>{!! date('d.m.Y',strtotime($sundayservice->sermons->date)) !!}</td>
				<td>{!! $sundayservice->kigos->users->username !!}</td>
				<td>{!! $sundayservice->kigos->lection_number !!}</td>
				<td>{!! $sundayservice->kigos->lection !!}</td>
				<td>{!! $sundayservice->users->username !!}</td>
				<td>{!! $sundayservice->sermons->members->onlinename !!}</td>
				<td><a href="editsunday/{!! $sundayservice->id!!}"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a></td>

			</tr>
			@endforeach
		</tbody>
	</table>	
</div>
@stop
