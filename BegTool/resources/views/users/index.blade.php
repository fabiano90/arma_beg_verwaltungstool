@extends('layouts.main') 

@section('content')
{!! showMessageAndErrors(Session::get('message'), $errors->all()) !!}
<h2>Willkommen {!! $user->username !!}</h2>
<div class="table-responsive">
	<input id="filter" class="form-control" type="text" placeholder="Suche">
	<table class="table table-striped table-hover footable" data-filter="#filter">
		<thead>
			<tr>
				<th data-sort-initial="true">Datum</th>
				<th>Dienst</th>
				<th>Wer?</th>
			</tr>
		</thead>
		<tbody>
			@foreach($kigos as $kigo)
			<tr>
				<td data-type="numeric" data-value='{!! $kigo->sermons->date !!}'>{!! date('d.m.Y', $kigo->sermons->date) !!}</td>
				<td>Kigo</td>
				<td>{!! $kigo->users->username !!}</td>
			</tr>
			@endforeach
			@foreach($lektors as $lektor)
			<tr>
				<td data-type="numeric" data-value='{!! $lektor->sermons->date !!}'>{!! date('d.m.Y', $lektor->sermons->date) !!}</td>
				<td>Leitung</td>
				<td>{!! $lektor->users->username !!}</td>
			</tr>
			@endforeach
			@foreach($sermons as $sermon)
			<tr>
				<td data-type="numeric" data-value='{!! $sermon->date !!}'>{!! date('d.m.Y', $sermon->date) !!}</td>
				<td>Predigt</td>
				<td>{!! $sermon->members->firstname !!}</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>

<br />



{!! HTML::link('#', 'Zurück', array('class' => 'btn btn-default',
'onClick="javascript:history.back();return false;"'))!!} @stop
