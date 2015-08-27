
@extends('sundays.index') 

@section('kalendermenu')

	<li role="presentation" class="active"><a href="sundays/newsunday"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Gottesdienst</a></li>
	<li role="presentation"><a href='{!! 'newyear/'.date('Y')!!}'><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> {!!' Jahr '.date('Y')!!}</a></li>
	<li role="presentation"><a href='{!! 'newyear/'.date("Y", strtotime(date("Y", strtotime(date("Y"))) . " + 1 year"))!!}'><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>{!!'Jahr '.date("Y", strtotime(date("Y", strtotime(date("Y"))) . " + 1 year"))!!}</a></li>
	<li role="presentation"><a href='{!!'edityear/'.date('Y')!!}'><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>{!!' Jahr '. date('Y')!!}</a></li>
	<li role="presentation"><a href='{!! 'edityear/'.date("Y", strtotime(date("Y", strtotime(date("Y"))) . " + 1 year"))!!}'><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>{!!' Jahr '. date("Y", strtotime(date("Y", strtotime(date("Y"))) . " + 1 year"))!!}</a></li>
	
	<form class="navbar-form navbar-right" role="search">
 		 <div class="form-group">
   		 	<input type="text" class="form-control" placeholder="Suchen">
		 </div>
  	</form>

@stop