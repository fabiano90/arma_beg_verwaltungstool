@extends('layouts.main')

@section('content')


<h2>Geburtstage der Gemeindemitglieder</h2>
<div class="table-responsive">
	<table class="table table-striped table-hover">
		<thead>
			<tr>
				<th>Name</th>
				<th>Nummer</th>
				<th>Bemerkung</th>				
				<th width="40%">Bearbeiten</th>
			</tr>
		</thead>
		<tbody>
			@foreach($songs as $song)
			<tr>
				<td>{!! $song->name !!}</td>
				<td>{!! $song->number !!}</td>
				<td>{!! $song->annotation !!}</td>	
				<td>
					<div class="btn-group">{!! HTML::link('/members/editsong/'.$song->id, 'bearbeiten', array('class'=>'btn btn-default')) !!}
					</div>
				</td>		
			</tr>
			@endforeach
		</tbody>
	</table>
</div>
{!! str_replace('/?', '?', $songs->render()) !!}
<br/>


{!! HTML::link('songs/addsong', 'Hinzufügen', array('class' => 'btn btn-default'))!!}
{!! HTML::link('#', 'Zurück', array('class' => 'btn btn-default', 'onClick="javascript:history.back();return false;"'))!!}
@stop			