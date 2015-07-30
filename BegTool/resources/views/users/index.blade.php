@extends('layouts.main')

@section('content')
<h2>Benutzer</h2>
<div class="table-responsive">
	<table class="table table-striped table-hover">
		<thead>
			<tr>
				<th>Name</th>
				<th>Vorname</th>
				<th>Benutzername</th>
				<th width="40%">Bearbeiten</th>
			</tr>
		</thead>
		<tbody>
			@foreach($users as $user)
			<tr>
				<td>{!! $user->lastname !!}</td>
				<td>{!! $user->firstname !!}</td>
				<td>{!! $user->username !!}</td>
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


{!! HTML::link('users/register', 'Hinzuf�gen', array('class' => 'btn btn-default'))!!}
{!! HTML::link('#', 'Zur�ck', array('class' => 'btn btn-default', 'onClick="javascript:history.back();return false;"'))!!}
@stop