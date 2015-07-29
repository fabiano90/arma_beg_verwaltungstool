@extends('layouts.main')

@section('content')
    <h2>Nutzer mit Geburtsdaten</h2>
    <div class="table-responsive">
	    <table class="table table-striped table-hover">
	    	<thead>
	    		<tr>
		    		<th>Cooler Name</th>
		    		<th>Vorname</th>
		    		<th>Geburtsdatum</th>
		    		<th width="40%">Bearbeiten</th>
		    	</tr>
	    	</thead>
	    	<tbody>
	    @foreach($users as $user)
		    	<tr>
		        	<td>{!! $user->lastname !!}</td>
		        	<td>{!! $user->firstname !!}</td>
		        	<td>{!! date("d.m.Y", strtotime($user->birthdate)) !!}</td>
		        	<td><div class="btn-group">{!! HTML::link('/users/addgrade/'.$user->id, 'Note hinzufügen', array('class'=>'btn btn-default')) !!}{!! HTML::link('/users/show/'.$user->id, 'Ansehen', array('class'=>'btn btn-default')) !!}{!! HTML::link('/users/edit/'.$user->id, 'Bearbeiten', array('class'=>'btn btn-default')) !!}{!! HTML::link('/users/delete/'.$user->id, 'Löschen', array('class'=>'btn btn-default', 'onClick'=>'return confirm(\'Wirklich löschen?\');')) !!}</div></td>
		        </tr>
	    @endforeach
	    	</tbody>
	   	</table>
	</div>

	<br/>
	

	{!! HTML::link('users/new', 'Hinzufügen', array('class' => 'btn btn-default'))!!}
	{!! HTML::link('#', 'Zurück', array('class' => 'btn btn-default', 'onClick="javascript:history.back();return false;"'))!!}
@stop