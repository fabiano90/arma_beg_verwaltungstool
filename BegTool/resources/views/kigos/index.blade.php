@extends('layouts.main')

@section('content')


<h2>Kigos</h2>

<div class="table-responsive">
	<table class="table table-striped table-hover">
		<thead>
			<tr>
				<th>Kigoleiter</th>
				<th>Lektionsnummer</th>
				<th>Thema</th>				
				<th width="40%">Leitgedanke & Anwendung</th>
				<th>Material</th>				
				<th>Basteln</th>				
			</tr>
		</thead>
		<tbody>			
			@foreach($kigos as $kigo)
			<tr>
				<td>{!! $kigo->username !!}</td>
				<td>{!! $kigo->lection_number !!}</td>				
				<td>{!! $kigo->lection !!}</td>	
				<td>{!! $kigo->conclusion !!}</td>	
				<td>{!! $kigo->material !!}</td>
				<td>{!! $kigo->crafting !!}</td>		
				<td>
					<div class="btn-group">						
						{!! HTML::link('/kigos/editkigo/'.$kigo->id, 'Bearbeiten', array('class'=>'btn btn-default')) !!}
						{!! HTML::link('/kigos/deletekigo/'.$kigo->id, 'Löschen', array('class'=>'btn btn-default', 'onClick'=>'return confirm(\'Wirklich löschen?\');')) !!}
					</div>				
				</td>		
			</tr>
			@endforeach
		</tbody>
	</table>
</div>

<br/>
{!! HTML::link('#', 'Zurück', array('class' => 'btn btn-default', 'onClick="javascript:history.back();return false;"'))!!}
@stop			