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
						@if($auth_user->permission == 0 || $auth_user->member_id == $member->id)
							{!! HTML::link('/members/editmember/'.$member->id, 'Bearbeiten', array('class'=>'btn btn-default')) !!}
							@if($auth_user->member_id != $member->id)
								{!! HTML::link('/members/deletemember/'.$member->id, 'X', array('class'=>'btn btn-default', 'onClick'=>'return confirm(\'Wirklich löschen?\');')) !!}
							@endif
							{{-- Nur als Mitarbeiter hinzufügbar, wenn sie noch nicht sind --}}
							{{-- HTML Kommentare nicht löschen! --}}
								<!--{!! $temp = -1 !!}-->
								@foreach ($users as $user)
		    						@if($member->id == $user->member_id)
		    							<!--{!! $temp = $user->id; !!}-->
									@endif
								@endforeach
								@if($temp == -1)
									{!! HTML::link('/members/adduser/'.$member->id, 'Als Mitarbeiter hinzufügen', array('class'=>'btn btn-default')) !!}						
								@endif
						@endif						
					</div>
				</td>				
			</tr>
			@endforeach
		</tbody>
	</table>
</div>
<br/>


{!! HTML::link('members/register', 'Hinzufügen', array('class' => 'btn btn-default'))!!}
{!! HTML::link('#', 'Zurück', array('class' => 'btn btn-default', 'onClick="javascript:history.back();return false;"'))!!}
@stop			