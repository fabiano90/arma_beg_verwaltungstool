@extends('layouts.main') 

<<<<<<< HEAD
@section('mainslider')
<div id="carousel-example-generic" class="carousel slide content-shadow content-box" data-ride="carousel">
    <!-- Positionsanzeiger -->
    <ol class="carousel-indicators">
        <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
        <li data-target="#carousel-example-generic" data-slide-to="1"></li>
        <li data-target="#carousel-example-generic" data-slide-to="2"></li>
    </ol>

    <!-- Verpackung für die Elemente -->
    <div class="carousel-inner" role="listbox">
        <div class="item active">
            <div class="table-responsive">
                <table class=" table-striped table-hover footable" data-filter="#filter">
                    <thead>
                        <tr>
                            <th data-sort-initial="true">Datum</th>
                            <th>Dienst</th>
                            <th>Bearbeiten</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($kigos as $kigo)
                        <tr>
                            <td data-type="numeric" data-value='{!! $kigo->sermons->date !!}'>{!! date('d.m.Y', $kigo->sermons->date) !!}</td>
                            <td>Kigo</td>
                            <td>{!! $kigo->users->username !!}</td>
                        </tr>
                        @endforeach 
                        @foreach($lektors as $lektor)
                        <tr>
                            <td data-type="numeric" data-value='{!! $lektor->sermons->date !!}'>{!! date('d.m.Y', $lektor->sermons->date) !!}</td>
                            <td>Leitung</td>
                            <td>{!! $lektor->users->username !!}</td>
                        </tr>
                        @endforeach 
                        @foreach($sermons as $sermon)
                        <tr>
                            <td data-type="numeric" data-value='{!! $sermon->date !!}'>{!! date('d.m.Y', $sermon->date) !!}</td>
                            <td>Predigt</td>
                            <td>{!! $sermon->members->firstname !!}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>


    </div>

    <!-- Schalter -->
    <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Zurück</span>
    </a>
    <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Weiter</span>
    </a>
</div>
@stop @section('content')
<div class="row">
    <div class="col-md-4">
        <div class="content-shadow content-box text-center">
                    <h2><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>  Nachrichten</h2>
           
        </div>
    </div>
    <div class="col-md-4">
        <div class="content-shadow content-box text-center">
            <h2><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>  Übersicht</h2>
        </div>
    </div>
    <div class="col-md-4">
      <div class="content-shadow content-box text-center">
                   <h2><span class="glyphicon glyphicon-music text-center" aria-hidden="true"></span>  Lieder</h2>
           
        </div>
    </div>
=======
@section('content')
{!! showMessageAndErrors(Session::get('message'), $errors->all()) !!}
<h2>Willkommen {!! $user->username !!}</h2>
<div class="table-responsive">
	<input id="filter" class="form-control" type="text" placeholder="Suche">
	<table class="table table-striped table-hover footable" data-filter="#filter">
		<thead>
			<tr>
				<th data-sort-initial="true">Datum</th>
				<th>Dienst</th>
				<th>Wer?</th>
			</tr>
		</thead>
		<tbody>
			@foreach($kigos as $kigo)
				<tr>
					<td data-type="numeric" data-value='{!! $kigo->sermons->date !!}'>{!! date('d.m.Y', $kigo->sermons->date) !!}</td>
					<td>Kigo</td>
					<td>{!! $kigo->users->username !!}</td>
				</tr>
				@endforeach
				@foreach($lektors as $lektor)
				<tr>
					<td data-type="numeric" data-value='{!! $lektor->sermons->date !!}'>{!! date('d.m.Y', $lektor->sermons->date) !!}</td>
					<td>Leitung</td>
					<td>{!! $lektor->users->username !!}</td>
				</tr>
				@endforeach
				@foreach($sermons as $sermon)
				<tr>
					<td data-type="numeric" data-value='{!! $sermon->date !!}'>{!! date('d.m.Y', $sermon->date) !!}</td>
					<td>Predigt</td>
					<td>{!! $sermon->members->firstname !!}</td>
				</tr>
			@endforeach
		</tbody>
	</table>
>>>>>>> branch 'master' of https://github.com/fabiano90/arma_beg_verwaltungstool.git
</div>

{!! showMessageAndErrors(Session::get('message'), $errors->all()) !!}



@stop