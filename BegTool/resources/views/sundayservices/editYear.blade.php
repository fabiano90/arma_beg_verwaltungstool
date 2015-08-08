@extends('layouts.main')

@section('content')

{!! Form::model($sundays, array('url' => array('sundayservices/edityear'))) !!}

{!! showMessageAndErrors(Session::get('message'), $errors->all()) !!}
<input id="filter" class="form-control" type="text" placeholder="Suche">
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
