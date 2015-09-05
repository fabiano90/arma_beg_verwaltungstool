@extends('layouts.main')
@section('messages') 
    @if($newMessages>'0')
    <span class="label label-danger message-cound">
        {!!$newMessages." neu"!!}</span> 
    @endif 
@stop
@section('menu')


	<ul class="nav nav-tabs">	
  		<li role="presentation"><a title="Neues Mitglied hinzufügen" href="/members/register"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Hinzufügen</a></li>
  		<li role="presentation" class="navbar-right"><input id="filter" type="text" class="search-form" placeholder="Suchen"></li>
	</ul>
</div>
@stop

@section('content')
<section class="section content-shadow content-box">
	<h2>Mitgliederliste</h2>	
	<div class="table-responsive">	
		<table class="table table-striped table-hover footable toggle-default" data-filter="#filter">
			<thead>
				<tr>				
					<th>Name</th>
					<th data-hide="phone">Geburtsdatum</th>				
					<th data-hide="phone">E-Mail</th>	
					@if($auth_user->permission == 0)			
						<th data-hide="phone">Berechtigungen</th>
					@endif
					<th data-hide="phone">Bearbeiten</th>
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
									@if($member->id == $user->member_id)
										{!! $user->email !!} 
									@endif
								@endforeach
							</td>
							@if($auth_user->permission == 0)
								{{-- HTML Kommentare nicht löschen!!! --}}
								<!--{!! $temp = -1 !!}-->
								@foreach ($users as $user)
		    						@if($member->id == $user->member_id)
		    							<!--{!! $temp = $user->id; !!}-->										
										@if($user->permission == 0)
											<td>Admin</td>
										@elseif($user->permission == 1)
											<td>Leitung & Kigo</td>
										@elseif($user->permission == 2)
											<td>Kigo anlegen</td>
										@endif
									@else

									@endif
								@endforeach
								@if($temp == -1)
									<td><a href="/members/adduser/{!! $member->id !!}" title="Nutzeraccount anlegen" class="btn btn-default"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> als Mitarbeiter hinzufügen</a>			 															
										</td>
								@endif
							@endif
							<td>
								<div class="btn-group">
									@if($auth_user->permission == 0 || $auth_user->member_id == $member->id)						
										

										{{-- Nur als Mitarbeiter hinzufügbar, wenn sie noch nicht sind --}}
										{{-- HTML Kommentare nicht löschen!!! --}}
										<!--{!! $temp = -1 !!}-->
										@foreach ($users as $user)
				    						@if($member->id == $user->member_id)
				    							<!--{!! $temp = $user->id; !!}-->
											@endif
											@if($member->id == $user->member_id && ($auth_user->permission == 0 || $auth_user->id == $user->id))
												<a href="/users/edituser/{!! $member->id !!}" title="Bearbeiten" class="btn btn-default"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>			
												<a href="/users/editpassword/{!! $user->id !!}" title="Passwort ändern" class="btn btn-default"><span class="glyphicon glyphicon-lock" aria-hidden="true"></span></a>			 												
											@endif
										@endforeach
										@if($temp == -1)
											<a href="/members/editmember/{!! $member->id !!}" title="Bearbeiten" class="btn btn-default"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>			
										@endif
										@if($auth_user->member_id != $member->id)
											<a href=""  title="Mitglied löschen" onClick="if(confirm('Wirklich löschen?') == true){window.location = '/members/deletemember/{!! $member->id !!}';}else{window.location = '/members';}" class="btn btn-default"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>			
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
</section>
@stop			