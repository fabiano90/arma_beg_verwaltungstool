@extends('layouts.main')

@section('content')


<h2>Kigo</h2>
<div class="table-responsive">
<input id="filter" class="form-control" type="text" placeholder="Suche">
	<table class="table table-striped table-hover footable toggle-default" data-filter="#filter">
		<thead>
			<tr>
				<th data-sort-initial="true">Datum</th>
				<th>Kigoleiter</th>
				<th>Lektionsnummer</th>
				<th>Thema</th>				
				<th data-hide="phone">Leitgedanke & Anwendung</th>
				<th data-hide="all">Material</th>				
				<th data-hide="all">Basteln</th>	
				<th data-hide="all">Lieder</th>			
				<th data-hide="all">Bearbeiten</th>		
			</tr>
		</thead>
		<tbody>			
			@foreach($kigos as $kigo)
				<tr>
					<td data-type="numeric" data-value='{!! $kigo->sundayservices->sermons->date !!}'>{!! date('d.m.Y', $kigo->sundayservices->sermons->date) !!}</td>
					<td>{!! $kigo->users->username !!}</td>
					<td>{!! $kigo->lection_number !!}</td>				
					<td>{!! $kigo->lection !!}</td>	
					<td>{!! $kigo->conclusion !!}</td>	
					<td>{!! $kigo->material !!}</td>
					<td>{!! $kigo->crafting !!}</td>	
					<td>
						@foreach($kigo->songs as $song)	
							{!! $song->name !!}<br/>
						@endforeach	
					</td>
					<td>
						<div class="btn-group">		
							@if($auth_user->permission <= 2)						
								<a href="/kigos/editkigo/{!! $kigo->id !!}" class="btn btn-default"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>																					
								<a href=""  title="Inhalt leeren?" onClick="if(confirm('Inhalt leeren?') == true){window.location = '/kigos/deletekigo/{!!$kigo->id!!}';}else{window.location = '/kigos';}" class="btn btn-default"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a>								
							@endif
						</div>				
					</td>		
				</tr>
			@endforeach
		</tbody>
	</table>
</div>

<br/>
@stop			