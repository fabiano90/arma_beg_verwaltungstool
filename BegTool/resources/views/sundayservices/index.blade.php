@extends('layouts.main') @section('content')

<h2>Übersicht Leitung</h2>
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

		</tbody>
	</table>
</div>
@stop
