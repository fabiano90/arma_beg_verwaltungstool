@extends('layouts.main') 
@section('menu')
  	<ul class="nav nav-tabs">
  	 
	<li role="presentation" ><a href="" class="filter-api set_aktive" value='{!! date("Y")!!}' title=""><span class="glyphicon glyphicon-filter" aria-hidden="true"></span> {!! date("Y")!!}</a></li>
	<li role="presentation" ><a href="" class="filter-api set_aktive" value='{!! date("m.Y") !!}'  title=""><span class="glyphicon glyphicon-filter" aria-hidden="true"></span> {!! date("F") !!}</a></li>
	<li role="presentation" ><a href="" class="filter-api set_aktive" value='{!! date("m.Y", strtotime("+ 1 month"))!!}' title=""><span class="glyphicon glyphicon-filter" aria-hidden="true"></span> {!! date("F", strtotime("+ 1 month"))!!}</a></li>
	<li role="presentation" ><a href="" class="filter-api set_aktive" value='{!! date("Y", strtotime(" + 1 year"))!!}' title=""><span class="glyphicon glyphicon-filter" aria-hidden="true"></span> {!! date("Y", strtotime(" + 1 year"))!!}</a></li>

	 
	  <li role="presentation" class="navbar-right"><input id="filter" type="text" class="search-form" placeholder="Suchen"></li>
	</ul>
</div>
@stop

@section('content')
<section class="section content-shadow content-box">

<h2 class='header'>Leitung</h2>
<div class="table-responsive">
	<table class="table table-striped table-hover footable" data-filter="#filter">
		<thead id='summary'>
			<tr>
				<th data-sort-initial="true">Datum</th>
				<th data-hide="phone">Leitung</th>
				<th data-hide="phone">Gottesdienst</th>
				<th data-hide="phone">Psalm</th>
				<th data-hide="all">Schriftlesung</th>
				<th data-hide="all">Kommentar</th>
				<th data-hide="all">Abendmahl</th>
				<th data-hide="all">Lieder</th>
				<th></th>
			</tr>
		</thead>

		<tbody>
			@foreach($sundayservices as $sundayservice)
				<tr>				
					<td data-type="numeric" data-value='{!! $sundayservice->sermons->date!!}'>{!! date('d.m.Y', $sundayservice->sermons->date) !!}</td>
					<td>{!! $sundayservice->sermons->members->onlinename !!}</td>
					<td>{!! $sundayservice->users->username !!}</td>
					<td>{!! $sundayservice->psalm !!}</td>
					<td>{!! $sundayservice->biblereading !!}</td>
					<td>{!! $sundayservice->comments !!}</td>
					<td>{!! $sundayservice->sacrament !!}</td>
					<td>
						<ol>
							@foreach($sundayservice->songs as $song)	
								<li>{!! $song->name !!}<br/></li>
							@endforeach	
						</ol>
					</td>
					<td>						
						<div class="btn-group">
															
							<a href="/sundayservices/editservice/{!! $sundayservice->id !!}" class="btn btn-default"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>			
							<a href="/sundayservices/pdf/{!! $sundayservice->id !!}" class="btn btn-default"><span class="glyphicon glyphicon-download-alt" aria-hidden="true"></span></a>
					</div>	
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>	
</div>
</section>
@stop
