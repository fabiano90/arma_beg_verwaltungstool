@extends('layouts.main') @section('content')

<h2>Kalender</h2>
<div  class="table-responsive">
	<table id="leitung" class="table table-striped table-hover">
		<thead>
			<tr>
				<th>Sonntag</th>
				<th>Leitung</th>
				<th>Prediger</th>
				<th>Kigo</th>
				<th>Psalm</th>
				<th>Lieder</th>
				<th>comments</th>
				<th>sacrament</th>
			</tr>
		</thead>

		<tbody>

			<tr>
				<td>$sunday->sermon(_id->date 12.04.2015</td>
				<td>$sunday->user_id Tim</td>
				<td>$sunday->sermon)->preacher_id Prediger</td>
				<td>$sunday->kigo()->user_id Tim</td>
				<td>$sunday->psalm Psalm 104</td>
				<td>$sunday->biblereading 102 Lobe den Herren</td>
				<td>$sunday->comments Kommi</td>
				<td>$sunday->sacrament Sakra</td>
			</tr>
			@foreach($sundayservices as $sunday)
			<tr>				
				<td>{!! $sunday->sermon_id !!} -> date 12.04.2015</td>
				<td>{!! $sunday->kigo_id !!} Tim</td>
				<td>$sunday->sermon)->preacher_id Prediger</td>
				<td>$sunday->kigo()->user_id Tim</td>
				<td>$sunday->psalm Psalm 104</td>
				<td>$sunday->biblereading 102 Lobe den Herren</td>
				<td>$sunday->comments Kommi</td>
				<td>$sunday->sacrament Sakra</td>
			</tr>
			@endforeach
		</tbody>
	</table>	
</div>

{!! HTML::link('sundayservices/newsunday', 'Hinzuf&uuml;gen', array('class' => 'btn btn-default'))!!}
@stop
