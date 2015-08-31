@extends('layouts.main') @section('content')

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
						@foreach($sundayservice->songs as $song)	
							{!! $song->name !!}<br/>
						@endforeach	
					</td>
					<td>						
						<div class="btn-group">								
							<a href="/public/sundayservices/editservice/{!! $sundayservice->id !!}" class="btn btn-default"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>			
							{!! HTML::link('/sundayservices/deleteservice/'.$sundayservice->id, 'X', array('class'=>'btn btn-default', 'onClick'=>'return confirm(\'Inhalt dieses Lektordienstes löschen?\');')) !!}
						</div>	
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>	
</div>
@stop
