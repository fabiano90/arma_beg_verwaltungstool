@extends('layouts.main')

@section('content')
<h2>Lied zu Gottesdienst am {!!$sunday->sermons->date!!} hinzufügen</h2>

<h4>Bereits zum Gottesdienst hinzugefügte Lieder:</h4>
    @if($sunday->songs == '[]')
    	Bisher keine Lieder hinzugefügt.
    @endif
 	<ul>
		@foreach($sunday->songs as $song)
			<li>{!! $song->name !!}</li>
		@endforeach
	</ul>
<br/>


{!! Form::model($sunday, array('url' => array('/sundayservices/addsongtosunday', $sunday->id))) !!}
<div class="table-responsive">
{!! Form::submit('Lieder hinzufügen und Speichern', array('class'=>'btn btn-large btn-primary btn-block'))!!}
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
{!! Form::close() !!}
@stop			