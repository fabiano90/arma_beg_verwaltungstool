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

				<th>Bearbeiten</th>
			</tr>
		</thead>
		<tbody>
			@foreach($users as $user)
				@if($user->id != 0)
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
								{!! HTML::link('/messages/chat/'.$user->id, 'Nachricht schreiben', array('class'=>'btn btn-default')) !!}						
								@if($auth_user->permission == 0 || $auth_user->id == $user->id)							
									{!! HTML::link('/users/editpassword/'.$user->id, 'Passwort ändern', array('class'=>'btn btn-default')) !!}
									<a href="/public/users/edituser/{!! $user->id !!}" class="btn btn-default"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>			
									@if($auth_user->id != $user->id)
										{!! HTML::link('/users/deleteuser/'.$user->id, 'X', array('class'=>'btn btn-default', 'onClick'=>'return confirm(\'Wirklich löschen?\');')) !!}
									@endif
								@endif						
							</div>
						</td>
					</tr>
				@endif
			@endforeach
		</tbody>
	</table>
</div>
<br />



{!! HTML::link('#', 'Zurück', array('class' => 'btn btn-default',
'onClick="javascript:history.back();return false;"'))!!} @stop
