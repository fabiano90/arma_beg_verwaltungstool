@extends('layouts.main') 

@section('content')

<h2 class='header'>Leitung</h2>
<div class="table-responsive">
<input id="filter" class="form-control" type="text" placeholder="Suche">
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
							<a href=""  title="Inhalt leeren?" onClick="if(confirm('Inhalt leeren?') == true){window.location = '/sundayservices/deleteservice/{!!$sundayservice->id!!}';}else{window.location = '/sundayservices';}" class="btn btn-default"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a>
						</div>	
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>	
</div>
@stop
