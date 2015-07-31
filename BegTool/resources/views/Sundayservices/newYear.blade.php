@extends('layouts.main')
@section('content')

<table class="table table-striped table-hover">
	<tbody>
		<tr>
			<td>Sonntag</td>
		</tr>
		@foreach($sundays as$sunday)
		<tr>

				<td>{!! Form date('D, d.m.Y', $sunday) !!}</td>
		</tr>
		@endforeach
	</tbody>
</table>

@stop
