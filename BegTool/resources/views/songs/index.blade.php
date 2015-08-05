@extends('layouts.main')

@section('content')


<h2>Lieder</h2>
<div class="table-responsive">
	<table class="table table-striped table-hover">
		<thead>
			<tr>
				<th>Nummer</th>
				<th>Name</th>
				<th>Bemerkung</th>				
				<th width="40%">Bearbeiten</th>
			</tr>
		</thead>
		<tbody>
			@foreach($songs as $song)
			<tr>
				<td>{!! $song->number !!}</td>
				<td>{!! $song->name !!}</td>				
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
{!! str_replace('/?', '?', $songs->render()) !!}
<br/>


{!! HTML::link('songs/addsong', 'Hinzufügen', array('class' => 'btn btn-default'))!!}
{!! HTML::link('#', 'Zurück', array('class' => 'btn btn-default', 'onClick="javascript:history.back();return false;"'))!!}
@stop			