@extends('layouts.main') 
@section('title')
Kalender
@stop
@section('menu')
	<li role="presentation" class="active"><a href='sundays/newsunday'><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Gottesdienst</a></li>
	<li role="presentation"><a href='{!! 'sundays/newyear/'.date('Y')!!}'><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> {!!' Jahr '.date('Y')!!}</a></li>
	<li role="presentation"><a href='{!! 'sundays/newyear/'.date("Y", strtotime(date("Y", strtotime(date("Y"))) . " + 1 year"))!!}'><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>{!!'Jahr '.date("Y", strtotime(date("Y", strtotime(date("Y"))) . " + 1 year"))!!}</a></li>
	<li role="presentation"><a href='{!!'sundays/edityear/'.date('Y')!!}'><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>{!!' Jahr '. date('Y')!!}</a></li>
	<li role="presentation"><a href='{!! 'sundays/edityear/'.date("Y", strtotime(date("Y", strtotime(date("Y"))) . " + 1 year"))!!}'><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>{!!' Jahr '. date("Y", strtotime(date("Y", strtotime(date("Y"))) . " + 1 year"))!!}</a></li>
	
	<form class="navbar-form navbar-right search-div" role="search">
 		 <div class="form-group">
   		 	<input id="filter" type="text" class="search-form" placeholder="Suchen">
		 </div>
  	</form>

@stop

@section('content')

<div class="table-responsive">
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
		<tfoot>
 			<tr>
				<th data-sort-initial="true">Sonntag</th>
				<th>Kigo</th>
				<th data-hide="phone">Nr.</th>
				<th data-hide="phone">Lektion</th>
				<th>Lektor</th>
				<th>Prediger</th>
				<th></th>
			</tr>
        </tfoot>
		<tbody>
			@foreach($sundayservices as $sundayservice)
			<tr>				
				<td data-type="numeric" data-value='{!!$sundayservice->sermons->date!!}'>{!! date('d.m.Y',$sundayservice->sermons->date) !!}</td>
				<td>{!! $sundayservice->kigos->users->username !!}</td>
				<td>{!! $sundayservice->kigos->lection_number !!}</td>
				<td>{!! $sundayservice->kigos->lection !!}</td>
				<td>{!! $sundayservice->users->username!!}</td>
				<td>{!! $sundayservice->sermons->members->onlinename !!}</td>
				<td><a href="sundays/editsunday/{!! $sundayservice->id!!}"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a></td>

			</tr>
			@endforeach
		</tbody>
	</table>	
</div>
@stop
