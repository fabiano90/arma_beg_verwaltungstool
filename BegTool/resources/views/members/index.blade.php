@extends('layouts.main')

@section('content')
<h2>Geburtstage der Gemeindemitglieder</h2>
<div class="table-responsive">
	<table class="table table-striped table-hover">
		<thead>
			<tr>
				<th>Id</th>
				<th>Benutzername</th>
				<th>Geburtsdatum</th>				
				<th width="40%">Bearbeiten</th>
			</tr>
		</thead>
		<tbody>
			@foreach($members as $member)
			<tr>
				<td>{!! $member->firstname !!}</td>
				<td>{!! $member->lastname !!}</td>
				<td>{!! $member->birthdate !!}</td>
				<td>
					<div class="btn-group">{!! HTML::link('/members/adduser/'.$member->id, 'Als Mitarbeiter hinzufügen', array('class'=>'btn btn-default')) !!}
					</div>
				</td>				
			</tr>
			@endforeach
		</tbody>
	</table>
</div>
{!! str_replace('/?', '?', $members->render()) !!}
<br/>


{!! HTML::link('members/register', 'Hinzufügen', array('class' => 'btn btn-default'))!!}
{!! HTML::link('#', 'Zurück', array('class' => 'btn btn-default', 'onClick="javascript:history.back();return false;"'))!!}
@stop