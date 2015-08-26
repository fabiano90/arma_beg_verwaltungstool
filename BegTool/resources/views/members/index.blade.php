@extends('layouts.main')

@section('content')


<h2>Geburtstagsliste</h2>
<div class="table-responsive">
<input id="filter" class="form-control" type="text" placeholder="Suche">
	<table class="table table-striped table-hover footable toggle-default" data-filter="#filter">
		<thead>
			<tr>
				
				<th>Name</th>
				<th data-hide="phone">Geburtsdatum</th>				
				<th data-hide="phone"width="40%">Bearbeiten</th>
			</tr>
		</thead>
		<tbody>
			@foreach($members as $member)
			<tr>
				<td>{!! $member->onlinename !!}</td>
				<td data-type="numeric" data-value= '{!!$member->birthdate!!}'>{!! date('d.m.Y', $member->birthdate) !!}</td>
				<td>
					<div class="btn-group">
						{!! HTML::link('/members/editmember/'.$member->id, 'Bearbeiten', array('class'=>'btn btn-default')) !!}
						{!! HTML::link('/members/adduser/'.$member->id, 'Als Mitarbeiter hinzufügen', array('class'=>'btn btn-default')) !!}						
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