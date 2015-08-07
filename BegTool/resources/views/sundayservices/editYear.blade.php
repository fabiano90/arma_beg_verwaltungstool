@extends('layouts.main')

@section('content')
<input id="filter" class="form-control" type="text" placeholder="Suche">
	<table class="table table-striped table-hover footable toggle-default" data-filter="#filter">
{!! Form::model($sundays, array('url' => array('sundayservices/edityear', $year))) !!}
{!! showMessageAndErrors(Session::get('message'), $errors->all()) !!}


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
{!!$sunday->kigos->user_id!!}
		<tr>
			<td data-type="numeric" data-value= '{!!strtotime($sunday->sermons->date)!!}'> {!! date('d.m.Y', strtotime($sunday->sermons->date)) !!}</td>
			
			<td data-value= '{!!$sunday->kigos->users->username!!}'> {!! Form::select('kigos_list'.$sunday->id, $kigos_list, [$sunday->kigos->user_id], array('class'=>'form-control', 'style'=> '')) !!}</td>
			<td data-value= '{!!$sunday->kigos->lection_number!!}'> {!! Form::text('lection_number'.$sunday->id, $sunday->kigos->lection_number , array('class'=>'form-control ', 'placeholder'=>'Lektion')) !!}</td>
			<td data-value= '{!!$sunday->kigos->lection!!}'> {!! Form::text('lection'.$sunday->id, $sunday->kigos->lection , array('class'=>'form-control ', 'placeholder'=>'Thema')) !!}</td>

			<td data-value= '{!!$sunday->users->username!!}'> {!! Form::select('lectors_list'.$sunday->id, $lectors_list, [$sunday->user_id] , array('class'=>'form-control', 'style'=> '')) !!}</td>
			<td data-value= '{!!$sunday->sermons->members->onlinename!!}'> {!! Form::select('preachers_list'.$sunday->id, $preachers_list, [$sunday->sermons->members->onlinename] , array('class'=>'form-control', 'style'=> '')) !!}</td>
	
			
			
		
		</tr>
		@endforeach
	
	</tbody>
</table>
{!! Form::submit('Speichern', array('class'=>'btn btn-large btn-primary
btn-block'))!!} {!! Form::close() !!} @stop
