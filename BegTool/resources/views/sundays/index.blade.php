@extends('layouts.main') 

@section('menu')


  		<ul class="nav nav-tabs">

	
	  <li role="presentation" ><a href="#api" class="filter-api" title="Filter using the Filter API">{!! date("F   ") !!}</a></li>
	  <li role="presentation" class="dropdown">
	    <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
	      Bearbeiten<span class="caret"></span>
	    </a>
	    <ul class="dropdown-menu">
	      	<li role="presentation"><a href='/sundays/newsunday'><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Gottesdienst</a></li>
			<li role="presentation"><a href='{!! '/sundays/newyear/'.date('Y')!!}'><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> {!!' Jahr '.date('Y')!!}</a></li>
			<li role="presentation"><a href='{!! '/sundays/newyear/'.date("Y", strtotime(date("Y", strtotime(date("Y"))) . " + 1 year"))!!}'><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> {!!'Jahr '.date("Y", strtotime(date("Y", strtotime(date("Y"))) . " + 1 year"))!!}</a></li>
			<li role="presentation"><a href='{!!'/sundays/edityear/'.date('Y')!!}'><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> {!!' Jahr '. date('Y')!!}</a></li>
			<li role="presentation"><a href='{!! '/sundays/edityear/'.date("Y", strtotime(date("Y", strtotime(date("Y"))) . " + 1 year"))!!}'><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> {!!' Jahr '. date("Y", strtotime(date("Y", strtotime(date("Y"))) . " + 1 year"))!!}</a></li>
		
	    </ul>
	  </li>	  <li role="presentation" class="navbar-right"><input id="filter" type="text" class="search-form" placeholder="Suchen"></li>

	</ul>


</div>

	
	

@stop

@section('content')
<section class="section content-shadow content-box">

<h2>Kalender</h2>
<div class="table-responsive">
	<table class="table table-striped table-hover footable" data-filter="#filter">
		<thead>
			<tr>
				<th data-sort-initial="true">Sonntag</th>
				<th>Kigo</th>
				<th data-hide="phone">Nr.</th>
				<th data-hide="phone">Lektion</th>
				<th>Lektor</th>
				<th>Prediger</th>
				<th></th>
			</tr>
		</thead>
		<tfoot>
 			<tr>
				<th data-sort-initial="true">Sonntag</th>
				<th>Kigo</th>
				<th data-hide="phone">Nr.</th>
				<th data-hide="phone">Lektion</th>
				<th>Lektor</th>
				<th>Prediger</th>
				<th></th>
			</tr>
        </tfoot>
		<tbody>
			@foreach($sundayservices as $sundayservice)
			<tr>				
				<td data-type="numeric" data-value='{!!$sundayservice->sermons->date!!}'>{!! date('d.m.Y',$sundayservice->sermons->date) !!}</td>
				<td>{!! $sundayservice->kigos->users->username !!}</td>
				<td>{!! $sundayservice->kigos->lection_number !!}</td>
				<td>{!! $sundayservice->kigos->lection !!}</td>
				<td>{!! $sundayservice->users->username!!}</td>
				<td>{!! $sundayservice->sermons->members->onlinename !!}</td>
				<td>	
					<div class="btn-group">							
						<a href="/sundays/editsunday/{!! $sundayservice->id !!}" class="btn btn-default"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>			
						{!! HTML::link('/sundays/deletesunday/'.$sundayservice->id, 'X', array('class'=>'btn btn-default', 'onClick'=>'return confirm(\'Wirklich löschen?\');')) !!}
					</div>
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>	
</div>
</section>
@stop
