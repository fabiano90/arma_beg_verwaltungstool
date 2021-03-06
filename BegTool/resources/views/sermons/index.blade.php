@extends('layouts.main')

@section('content')


<h2>Predigt</h2>


<div class="table-responsive">
<input id="filter" class="form-control" type="text" placeholder="Suche">
	<table class="table table-striped table-hover footable toggle-default" data-filter="#filter">
		<thead>
			<tr>
				<th data-sort-initial="true">Datum</th>
				<th>Prediger</th>
				<th>Lektor</th>
				<th data-hide="phone">Predigttext</th>	
				<th data-hide="phone">Thema</th>					
				<th data-hide="phone">Unterpunkte</th>	
				<th data-hide="all">Serie</th>	
				<th data-hide="all">Buch</th>			
				<th data-hide="phone">Anlass</th>
				<th data-hide="all">Infos an Lektor</th>		
				<th data-hide="all">MP3-Link</th>	
				<th>Bearbeiten</th>	
			</tr>
		</thead>
		<tbody>			
			@foreach($sermons as $sermon)
			<tr>
				<td data-type="numeric" data-value='{!! $sermon->date!!}'>{!! date('d.m.Y', $sermon->date) !!}</td>
				<td>{!! $sermon->members->onlinename !!}</td>
				<td>{!! $sermon->sundayservices->users->username!!}</td>
				
				<td>{!! $sermon->scripture !!}</td>
				<td>{!! $sermon->topic !!}</td>
				<td><ol>{!! $sermon->subitem !!}</ol></td>
				<td>{!! $sermon->series !!}</td>
				<td>{!! $sermon->book !!}</td>
				<td>{!! $sermon->occasion !!}</td>
				<td>{!! $sermon->info_text !!}</td>
				<td>{!! $sermon->link !!}</td>
				<td>
					<div class="btn-group">		
						<a href="/sermons/editsermon/{!! $sermon->id !!}" class="btn btn-default"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>													
						<a href=""  title="Inhalt leeren?" onClick="if(confirm('Inhalt leeren?') == true){window.location = '/sermons/deletesermon/{!!$sermon->id!!}';}else{window.location = '/sermons';}" class="btn btn-default"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a>														
					</div>				
				</td>		
			</tr>
			@endforeach
		</tbody>
	</table>
</div>

<br/>
@stop			