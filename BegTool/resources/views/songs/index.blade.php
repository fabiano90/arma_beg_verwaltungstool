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
				<th data-hide="phone">Zuletzt gesungen</th>
				<th data-hide="phone">Bearbeiten</th>
			</tr>
		</thead>
		<tbody>
			@foreach($songs as $song)
			<tr>
				<td>{!! $song->number !!}</td>
				<td>{!! $song->name !!}</td>				
				<td>
					<ul>
						<div class="hide">{!!$count = 0; !!}</div>
						@foreach($sundays as $key => $value)
							@foreach($value as $song_id => $date)
								@foreach($date as $song_id2 => $date2)
									@if($song_id < 3 && $song_id2 == $song->id)
										<li>{!! $date2 !!}</li>
									@endif							
								@endforeach
							@endforeach
						@endforeach				
					</ul>
				</td>
				<td>		

				</td>	
				<td>{!! $song->annotation !!}</td>	
				<td>
					<div class="btn-group">						
						{!! HTML::link('/songs/asdas/'.$song->id, 'Ansehen', array('class'=>'btn btn-default')) !!}
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