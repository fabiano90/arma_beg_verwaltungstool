@extends('layouts.main') 
@section('content')
{!! showMessageAndErrors(Session::get('message'), $errors->all()) !!}
<h2>Mitarbeiter</h2>
<div class="table-responsive">
	<table class="table table-striped table-hover footable toggle-medium">
		<thead>
			<tr>
				<th>Benutzername</th>
				<th data-hide="phone">Berechtigungen</th>
				<th data-hide="phone">E-Mail</th>

				<th width="40%">Bearbeiten</th>
			</tr>
		</thead>
		<tbody>
			@foreach($users as $user)
			<tr>
				<td>{!! $user->username !!}</td>
				<td>{!! $user->permission !!}</td>
				<td>{!! $user->email !!}</td>
				<td>
					<div class="btn-group">
						{!! HTML::link('/users/edituser/'.$user->id, 'Bearbeiten', array('class'=>'btn btn-default')) !!}
						{!! HTML::link('/messages/chat/'.$user->id, 'Nachricht schreiben', array('class'=>'btn btn-default')) !!}						
					</div>
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>
{!! str_replace('/?', '?', $users->render()) !!}
<br />



{!! HTML::link('#', 'Zurück', array('class' => 'btn btn-default',
'onClick="javascript:history.back();return false;"'))!!} @stop
