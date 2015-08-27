@extends('layouts.main')
@section('title')
{!!' Jahr '.$year.' bearbeiten'!!}
@stop
@section('menu')
	<li role="presentation" ><a href='/public/sundays/newsunday'><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Gottesdienst</a></li>
	<li role="presentation"><a href='{!! '/public/sundays/newyear/'.date('Y')!!}'><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> {!!' Jahr '.date('Y')!!}</a></li>
	<li role="presentation"><a href='{!! '/public/sundays/newyear/'.date("Y", strtotime(date("Y", strtotime(date("Y"))) . " + 1 year"))!!}'><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>{!!'Jahr '.date("Y", strtotime(date("Y", strtotime(date("Y"))) . " + 1 year"))!!}</a></li>
	@if($year == date('Y'))
	<li role="presentation"class="active"><a href='{!!'/public/sundays/edityear/'.date('Y')!!}'><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>{!!' Jahr '. date('Y')!!}</a></li>
	<li role="presentation"><a href='{!! '/public/sundays/edityear/'.date("Y", strtotime(date("Y", strtotime(date("Y"))) . " + 1 year"))!!}'><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>{!!' Jahr '. date("Y", strtotime(date("Y", strtotime(date("Y"))) . " + 1 year"))!!}</a></li>
	@else
	<li role="presentation"><a href='{!!'/public/sundays/edityear/'.date('Y')!!}'><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>{!!' Jahr '. date('Y')!!}</a></li>
	<li role="presentation"class="active"><a href='{!! '/public/sundays/edityear/'.date("Y", strtotime(date("Y", strtotime(date("Y"))) . " + 1 year"))!!}'><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>{!!' Jahr '. date("Y", strtotime(date("Y", strtotime(date("Y"))) . " + 1 year"))!!}</a></li>
	@endif
	<form class="navbar-form navbar-right search-div" role="search">
 		 <div class="form-group">
   		 	<input id="filter" type="text" class="search-form" placeholder="Nach Datum suchen">
		 </div>
  	</form>
  	

@stop

@section('content')

{!! Form::model($sundays, array('url' => array('sundays/edityear'))) !!}

{!! showMessageAndErrors(Session::get('message'), $errors->all()) !!}
<table class="table table-striped table-hover footable toggle-default" data-filter="#filter">
	<thead>
		<tr>
			<th data-sort-initial="true">Sonntag</th>
			<th>Kigo</th>
			<th>Lektion</th>
			<th>Thema</th>
			<th>Lektor</th>
			<th>Prediger</th>
		</tr>
	</thaead>
	<tbody>
		@foreach($sundays as $sunday)
			<tr>
				<td data-type="numeric" data-value= '{!!$sunday->date!!}'> {!! date('d.m.Y', $sunday->date) !!}</td>
				<td data-value= '{!!$sunday->sundayservices->kigos->users->username!!}'> {!! Form::select('kigos_list'.$sunday->sundayservices->id, $kigos_list, [$sunday->sundayservices->kigos->user_id], array('class'=>'form-control', 'style'=> '')) !!}</td>
				<td data-value= '{!!$sunday->sundayservices->kigos->lection_number!!}'> {!! Form::text('lection_number'.$sunday->sundayservices->id, $sunday->sundayservices->kigos->lection_number , array('class'=>'form-control ', 'placeholder'=>'Lektion')) !!}</td>
				<td data-value= '{!!$sunday->sundayservices->kigos->lection!!}'> {!! Form::text('lection'.$sunday->sundayservices->id, $sunday->sundayservices->kigos->lection , array('class'=>'form-control ', 'placeholder'=>'Thema')) !!}</td>
				<td data-value= '{!!$sunday->sundayservices->users->username!!}'> {!! Form::select('lectors_list'.$sunday->sundayservices->id, $lectors_list, [$sunday->sundayservices->user_id] , array('class'=>'form-control', 'style'=> '')) !!}</td>
				<td data-value= '{!!$sunday->members->onlinename!!}'> {!! Form::select('preachers_list'.$sunday->sundayservices->id, $preachers_list, [$sunday->members->onlinename] , array('class'=>'form-control', 'style'=> '')) !!}</td>
			</tr>
		@endforeach
	
	</tbody>
</table>
{!! Form::submit('Speichern', array('class'=>'btn btn-large btn-primary
btn-block'))!!} {!! Form::close() !!} @stop
