@extends('layouts.main')

@section('content')
<h2>PERSONSOPERMSONSORNSO</h2>
<div class="table-responsive">
	<table class="table table-striped table-hover">
		<thead>
			<tr>
				<th>Id</th>
				<th>Benutzername</th>
				<th>Berechtigungen</th>
				
				<th width="40%">Bearbeiten</th>
			</tr>
		</thead>
		<tbody>
			@foreach($persons as $user)
			<tr>
				<td>{!! $user->firstname !!}</td>
				<td>{!! $user->lastname !!}</td>
				<td>{!! $user->birthdate !!}</td>
				<td>
					<div class="btn-group">{!! HTML::link('/users/addfriend/'.$user->id, 'Freund hinzufügen', array('class'=>'btn btn-default')) !!}
					</div>
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>
{!! str_replace('/?', '?', $persons->render()) !!}
<br/>


{!! HTML::link('persons/register', 'Hinzufügen', array('class' => 'btn btn-default'))!!}
{!! HTML::link('#', 'Zurück', array('class' => 'btn btn-default', 'onClick="javascript:history.back();return false;"'))!!}
@stop