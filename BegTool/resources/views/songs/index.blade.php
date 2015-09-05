@extends('layouts.main')
@section('messages') 
    @if($newMessages>'0')
    <span class="label label-danger message-cound">
        {!!$newMessages." neu"!!}</span> 
    @endif 
@stop 
@section('menu')
  	<ul class="nav nav-tabs">

		<li role="presentation"><a href='/songs/addsong'><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> neues Lied</a></li>

	  <li role="presentation" class="navbar-right"><input id="filter" type="text" class="search-form" placeholder="Suchen"></li>
	</ul>
</div>
@stop

@section('content')
<section class="section content-shadow content-box">
<h2>Lieder</h2>
<div class="table-responsive">
	<table class="table table-striped table-hover footable toggle-default" data-filter="#filter">
		<thead>
			<tr>
				<th>Nummer</th>
				<th>Name</th>
				<th data-hide="phone">Bemerkung</th>				
				<th data-hide="phone">Zuletzt gesungen</th>
				<th data-hide="phone">Anzahl gesungen dieses Jahr</th>
				<th data-hide="phone">Bearbeiten</th>
			</tr>
		</thead>
		<tbody>
			@foreach($songs as $song)
			<tr>
				<td>{!! $song->number !!}</td>
				<td>{!! $song->name !!}</td>				
				<td>
					{!! $song->annotation !!}
				</td>
				@if ($song->sundayservices->count()==0)
						<td data-type="numeric" data-value='0'>noch nicht gesungen</td>
					@else
				@foreach($song->sundayservices->reverse()->take(1) as $songdate)
				<td	data-type="numeric" data-value='{!! $songdate->pivot->songdate !!}' >
				@endforeach		

					
						@foreach($song->sundayservices->reverse()->take(3) as $songdate)
						{!! date('d.m.Y',$songdate->pivot->songdate)!!} {!! $songdate->users->username !!}  <br/>
						@endforeach	
					@endif 
				</td>	
				<td>{!!$song->sundayservices->count()!!}</td>
				<td>
					<div class="btn-group">								
						<a href="/songs/editsong/{!! $song->id !!}" class="btn btn-default"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>			
						@if ($user->permission==0)	
							<a href=""  title="Inhalt leeren?" onClick="if(confirm('Sontag wirklich löschen?') == true){window.location = '/sundays/deletesunday/'.$sundayservice->id';}else{window.location = '/sundays';}" class="btn btn-default"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>								
						@endif
					</div>				
				</td>		
			</tr>
			@endforeach
		</tbody>
	</table>
</div>
<br/>
</section>
@stop			