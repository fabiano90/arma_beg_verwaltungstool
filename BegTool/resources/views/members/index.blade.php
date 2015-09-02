@extends('layouts.main')

@section('content')


<h2>Geburtstagsliste</h2>
{!! showMessageAndErrors(Session::get('message'), $errors->all()) !!}
<div class="table-responsive">
<input id="filter" class="form-control" type="text" placeholder="Suche">
	<table class="table table-striped table-hover footable toggle-default" data-filter="#filter">
		<thead>
			<tr>				
				<th>Name</th>
				<th data-hide="phone">Geburtsdatum</th>				
				<th data-hide="phone">E-Mail</th>				
				<th data-hide="phone"width="40%">Bearbeiten</th>
			</tr>
		</thead>
		<tbody>
			@foreach($members as $member)
				@if($member->id != 0 && $member->deleted == null)
					<tr>
						<td>{!! $member->onlinename !!}</td>
						<td data-type="numeric" data-value= '{!!$member->birthdate!!}'>{!! date('d.m.Y', $member->birthdate) !!}</td>
						<td>
							@foreach ($users as $user)
								@if($member->id == $user->id)
									{!! $user->email !!}
								@endif
							@endforeach
						</td>
						<td>
							<div class="btn-group">
								@if($auth_user->permission == 0 || $auth_user->member_id == $member->id)						
									<a href="/members/editmember/{!! $member->id !!}" class="btn btn-default"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>			
									@if($auth_user->member_id != $member->id)
										<a href="#" onClick="if(confirm('Wirklich löschen?') == true){window.location = '/members/deletemember/{!! $member->id !!}';}else{window.location = '/members';}" class="btn btn-default"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>			
										{!! HTML::link('/members/deletemember/'.$member->id, 'X', array('class'=>'btn btn-default', 'onClick'=>'return confirm(\'WirklichWirklichWirklichWirklich löschen?\');')) !!}
									@endif
									{{-- Nur als Mitarbeiter hinzufügbar, wenn sie noch nicht sind --}}
									{{-- HTML Kommentare nicht löschen!!! --}}
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
				@endif
			@endforeach
		</tbody>
	</table>
</div>
<br/>


{!! HTML::link('members/register', 'Hinzufügen', array('class' => 'btn btn-default'))!!}
{!! HTML::link('#', 'Zurück', array('class' => 'btn btn-default', 'onClick="javascript:history.back();return false;"'))!!}
@stop			