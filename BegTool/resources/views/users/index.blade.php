@extends('layouts.main') 

@section('content')
{!! showMessageAndErrors(Session::get('message'), $errors->all()) !!}
<h2>Willkommen </h2>
<div class="table-responsive">
	<table class="table table-striped table-hover footable toggle-medium">
		<thead>
			<tr>
				<th>Datum</th>
				<th>Dienst</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			@foreach($kigos as $kigo)
			<tr>
				<td>{!! date('d.m.Y', $kigo->sundayservices->sermons->date) !!}</td>
				<td>Kigo</td>
				<td>

				</td>
			</tr>
			@endforeach
			@foreach($lektors as $lektor)
			<tr>
				<td>{!! date('d.m.Y', $lektor->sermons->date) !!}</td>
				<td>Leitung</td>
				<td>

				</td>
			</tr>
			@endforeach
			@foreach($sermons as $sermon)
			<tr>
				<td>{!! date('d.m.Y', $sermon->date) !!}</td>
				<td>Predigt</td>
				<td>

				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>

<br />



{!! HTML::link('#', 'Zurück', array('class' => 'btn btn-default',
'onClick="javascript:history.back();return false;"'))!!} @stop
