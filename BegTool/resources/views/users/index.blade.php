@extends('layouts.main')

@section('content')
<h2>Benutzer</h2>
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
			@foreach($users as $user)
			<tr>
				<td>{!! $user->person_id !!}</td>
				<td>{!! $user->username !!}</td>
				<td>{!! $user->permission !!}</td>
				<td>
					<div class="btn-group">{!! HTML::link('/users/addfriend/'.$user->id, 'Freund hinzufügen', array('class'=>'btn btn-default')) !!}
					</div>
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>
{!! str_replace('/?', '?', $users->render()) !!}
<br/>


{!! HTML::link('users/register', 'Hinzufügen', array('class' => 'btn btn-default'))!!}
{!! HTML::link('#', 'Zurück', array('class' => 'btn btn-default', 'onClick="javascript:history.back();return false;"'))!!}
@stop