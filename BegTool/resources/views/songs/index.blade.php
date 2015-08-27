@extends('layouts.main')

@section('content')


<h2>Lieder</h2>
<div class="table-responsive">
<input id="filter" class="form-control" type="text" placeholder="Suche">
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
				<td>
					<ol>
						<li>gestern</li>	
						<li>der Tag davor</li>	
						<li>1912</li>	
					</ol>
				</td>	
				<td>3</td>
				<td>
					<div class="btn-group">										
						{!! HTML::link('/songs/editsong/'.$song->id, 'Bearbeiten', array('class'=>'btn btn-default')) !!}
						{!! HTML::link('/songs/deletesong/'.$song->id, 'Löschen', array('class'=>'btn btn-default', 'onClick'=>'return confirm(\'Wirklich löschen?\');')) !!}
					</div>				
				</td>		
			</tr>
			@endforeach
		</tbody>
	</table>
</div>
<br/>


{!! HTML::link('songs/addsong', 'Hinzufügen', array('class' => 'btn btn-default'))!!}
{!! HTML::link('#', 'Zurück', array('class' => 'btn btn-default', 'onClick="javascript:history.back();return false;"'))!!}
@stop			