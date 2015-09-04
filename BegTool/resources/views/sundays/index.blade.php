@extends('layouts.main') 

@section('menu')


  	<ul class="nav nav-tabs">
  	 @if($filter==1)
	<li role="presentation" ><a href="/sundays/index/{!! strtotime('01.01.'.date('Y')) !!} " class="set_aktive"><span class="glyphicon glyphicon-filter" aria-hidden="true"></span> {!! date("Y") !!}</a></li>
	 @else
	<li role="presentation" class="active"><a href="/sundays/index/{!! strtotime('01.01.'.date('Y')) !!} " class="set_aktive"><span class="glyphicon glyphicon-filter" aria-hidden="true"></span> {!! date("Y") !!}</a></li>
	 @endif
	<li role="presentation" ><a href="" class="filter-api set_aktive" value='{!! date("m.Y") !!}'  title=""><span class="glyphicon glyphicon-filter" aria-hidden="true"></span> {!! date("F") !!}</a></li>
	<li role="presentation" ><a href="" class="filter-api set_aktive" value='{!! date("m.Y", strtotime("+ 1 month"))!!}' title=""><span class="glyphicon glyphicon-filter" aria-hidden="true"></span> {!! date("F", strtotime("+ 1 month"))!!}</a></li>
	<li role="presentation" ><a href="" class="filter-api set_aktive" value='{!! date("Y", strtotime(" + 1 year"))!!}' title=""><span class="glyphicon glyphicon-filter" aria-hidden="true"></span> {!! date("Y", strtotime(" + 1 year"))!!}</a></li>

	  @if($user->permission==0)
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
	  </li>	
	  @endif  
	  <li role="presentation" class="navbar-right"><input id="filter" type="text" class="search-form" placeholder="Suchen"></li>

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
				<th>Lektor</th>
				<th>Prediger</th>
				<th>Kigo</th>
				<th data-hide="phone">Nr.</th>
				<th data-hide="phone">Lektion</th>
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

				<td>{!! $sundayservice->users->username!!}</td>
				<td>{!! $sundayservice->sermons->members->onlinename !!}</td>
				<td>{!! $sundayservice->kigos->users->username !!}</td>
				<td>{!! $sundayservice->kigos->lection_number !!}</td>
				<td>{!! $sundayservice->kigos->lection !!}</td><td>
				
					<div class="btn-group">							
						<a href="/sundays/editsunday/{!! $sundayservice->id !!}" title="Dienste tauschen, Lektion hinzufügen"class="btn btn-default"><span class="glyphicon glyphicon-random" aria-hidden="true"></span></a>			
						@if ($user->permission==0)	
							<a href=""  title="Inhalt leeren?" onClick="if(confirm('Sontag wirklich löschen?') == true){window.location = '/sundays/deletesunday/'.$sundayservice->id';}else{window.location = '/sundays';}" class="btn btn-default"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>								
						@endif
					</div>

				</td>
			</tr>
			@endforeach
		</tbody>
	</table>	
</div>
</section>
@stop
