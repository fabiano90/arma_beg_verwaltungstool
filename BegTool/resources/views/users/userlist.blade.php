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
				<td>
					@if($user->permission == 0)
						Admin ({!! $user->permission !!})
					@elseif($user->permission == 1)
						Leitung & Kigo ({!! $user->permission !!})
					@elseif($user->permission == 2)
						Kigo anlegen ({!! $user->permission !!})
					@endif
				</td>
				<td>{!! $user->email !!}</td>
				<td>
					<div class="btn-group">
						@if($auth_user->permission == 0 || $auth_user->id == $user->id)
							{!! HTML::link('/users/edituser/'.$user->id, 'Bearbeiten', array('class'=>'btn btn-default')) !!}
							{!! HTML::link('/users/editpassword/'.$user->id, 'Passwort ändern', array('class'=>'btn btn-default')) !!}
						@endif
						{!! HTML::link('/messages/chat/'.$user->id, 'Nachricht schreiben', array('class'=>'btn btn-default')) !!}						
					</div>
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>
<br />



{!! HTML::link('#', 'Zurück', array('class' => 'btn btn-default',
'onClick="javascript:history.back();return false;"'))!!} @stop
