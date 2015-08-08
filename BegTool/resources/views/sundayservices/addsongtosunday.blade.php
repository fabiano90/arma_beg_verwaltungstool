@extends('layouts.main')

@section('content')
<h2>Lied zu Kigo am {!!$kigo->sundayservices->sermons->date!!} hinzufügen</h2>
<h5>Bereits zum Kigo hinzugefügte Lieder:</h5>
 	<ul>
		@foreach($kigo_songs as $song)
			<li>{!! $song->name !!}</li>
		@endforeach
	</ul>

<br/>


{!! Form::model($kigo, array('url' => array('kigos/addsongtokigo', $kigo->id))) !!}
<div class="table-responsive">
{!! Form::label('filter', 'Durch den Checkbox-Haken und anschließendem "Speichern" wird dem Kigo ein neuer Song hinzugefügt.') !!}
<input id="filter" class="form-control" type="text" placeholder="Suche">
	<table class="table table-striped table-hover footable toggle-default" data-filter="#filter">
		<thead>
			<tr>
				<th>Nummer</th>
				<th>Name</th>
				<th data-hide="phone">Bemerkung</th>				
				<th data-hide="phone" width="40%">Bearbeiten</th>
			</tr>
		</thead>
		<tbody>

			@foreach($songs as $song)
			<tr>
				<td>{!! $song->number !!}</td>
				<td>{!! $song->name !!}</td>				
				<td>{!! $song->annotation !!}</td>
				<td>
					{!! Form::checkbox('id'.$song->id, $song->id, false) !!}					
				</td>
			</tr>
			@endforeach

		</tbody>
	</table>
</div>
{!! Form::submit('Speichern', array('class'=>'btn btn-large btn-primary btn-block'))!!}
{!! Form::close() !!}
@stop			