@extends('layouts.main')

@section('content')
<h2>Freundesliste</h2>
<div class="table-responsive">
	<table class="table table-striped table-hover">
		<thead>
			<tr>
				<th>Name</th>
				<th>Vorname</th>
				<th>Benutzername</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			@foreach($friends as $friend)
			<tr>
				<td>{!! $friend->lastname !!}</td>
				<td>{!! $friend->firstname !!}</td>
				<td>{!! $friend->username !!}</td>
				<td><div class="btn-group">{!! HTML::link('/users/removefriend/'.$friend->id, 'Freund entfernen', array('class'=>'btn btn-default', 'onClick'=>'return confirm(\'Freundschaft wirklich beenden?\');')) !!}</div></td>

			</tr>
			@endforeach
		</tbody>
	</table>
</div>
<br/>



{!! HTML::link('#', 'Zurück', array('class' => 'btn btn-default', 'onClick="javascript:history.back();return false;"'))!!}
@stop