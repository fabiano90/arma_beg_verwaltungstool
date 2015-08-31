@extends('layouts.main') @section('content')
{!!HTML::script('js/addsong.js')!!} {!! Form::model($sunday, array('url'
=> array('sundayservices/editservice', $sunday->id))) !!} {!!
showMessageAndErrors(Session::get('message'), $errors->all()) !!}

<h2 class="form-signup-heading">Lektordienst für den: {!!
	date('d.m.Y',$sunday->sermons->date)!!}</h2>

{!! Form::label('song1', 'Lied 1'.$songsOrder[1]) !!} 
<div class="table-responsive">
	<div class="input-group">
		<input id="song1" class="form-control" type="text" placeholder="Suche">
		<span class="input-group-btn"><button class="btn btn-primary"
				type="button" data-toggle="collapse" data-target="#tableSong1"
				aria-expanded="false" aria-controls="collapseBeispiel">Liederliste</button>
        </span>

	</div>

	<div id="tableSong1" class="collapse">
		<table
			class="table table-striped table-hover footable toggle-default "
			data-filter="#song1">
			<thead>
				<tr>
					<th>Nr</th>
					<th>Name</th>
					<th data-hide="phone">Bemerkung</th>
					<th ><span class="glyphicon glyphicon-check" aria-hidden="true"></span></th>
				</tr>
			</thead>
			<tbody>

				@foreach($songs as $song)
				<tr>
					<td>{!! $song->number !!}</td>
					<td>{!! $song->name !!}</td>
					<td>{!! $song->annotation !!}</td>
					<td>{!! Form::radio('song1', $song->id, false) !!}</td>
				</tr>
				@endforeach

			</tbody>
		</table>
	</div> </div>

{!! Form::label('psalm', 'Psalm') !!} 
{!! Form::text('psalm', null, array('class'=>'form-control', 'placeholder'=>'Psalm')) !!} 

{!! Form::label('song2', 'Lied 2'.$songsOrder[2]) !!} 
<div class="table-responsive">
    <div class="input-group">
        <input id="song2" class="form-control" type="text" placeholder="Suche">
        <span class="input-group-btn"><button class="btn btn-primary"
                type="button" data-toggle="collapse" data-target="#tableSong2"
                aria-expanded="false" aria-controls="collapseBeispiel">Liederliste</button>
        </span>

    </div>

    <div id="tableSong2" class="collapse">
        <table
            class="table table-striped table-hover footable toggle-default "
            data-filter="#song2">
            <thead>
                <tr>
                    <th>Nr</th>
                    <th>Name</th>
                    <th data-hide="phone">Bemerkung</th>
                    <th ><span class="glyphicon glyphicon-check" aria-hidden="true"></span></th>
                </tr>
            </thead>
            <tbody>

                @foreach($songs as $song)
                <tr>
                    <td>{!! $song->number !!}</td>
                    <td>{!! $song->name !!}</td>
                    <td>{!! $song->annotation !!}</td>
                    <td>{!! Form::radio('song2', $song->id, false) !!}</td>
                </tr>
                @endforeach

            </tbody>
        </table>
    </div> </div>

{!! Form::label('biblereading', 'Schriftlesung') !!} 
{!! Form::text('biblereading', null, array('class'=>'form-control', 'placeholder'=>'Schriftlesung')) !!} 

{!! Form::label('song3', 'Lied 3'.$songsOrder[3]) !!} 
<div class="table-responsive">
    <div class="input-group">
        <input id="song3" class="form-control" type="text" placeholder="Suche">
        <span class="input-group-btn"><button class="btn btn-primary"
                type="button" data-toggle="collapse" data-target="#tableSong3"
                aria-expanded="false" aria-controls="collapseBeispiel">Liederliste</button>
        </span>

    </div>

    <div id="tableSong3" class="collapse">
        <table
            class="table table-striped table-hover footable toggle-default "
            data-filter="#song3">
            <thead>
                <tr>
                    <th>Nr</th>
                    <th>Name</th>
                    <th data-hide="phone">Bemerkung</th>
                    <th ><span class="glyphicon glyphicon-check" aria-hidden="true"></span></th>
                </tr>
            </thead>
            <tbody>

                @foreach($songs as $song)
                <tr>
                    <td>{!! $song->number !!}</td>
                    <td>{!! $song->name !!}</td>
                    <td>{!! $song->annotation !!}</td>
                    <td>{!! Form::radio('song3', $song->id, false) !!}</td>
                </tr>
                @endforeach

            </tbody>
        </table>
    </div> </div>

{!! Form::label('comments', 'Abkündigungen') !!} 
{!! Form::text('comments', null, array('class'=>'form-control', 'placeholder'=>'Abkündigungen')) !!} 

{!! Form::label('song4', 'Predigtlied'.$songsOrder[4]) !!} 
<div class="table-responsive">
    <div class="input-group">
        <input id="song4" class="form-control" type="text" placeholder="Suche">
        <span class="input-group-btn"><button class="btn btn-primary"
                type="button" data-toggle="collapse" data-target="#tableSong4"
                aria-expanded="false" aria-controls="collapseBeispiel">Liederliste</button>
        </span>

    </div>

    <div id="tableSong4" class="collapse">
        <table
            class="table table-striped table-hover footable toggle-default "
            data-filter="#song4">
            <thead>
                <tr>
                    <th>Nr</th>
                    <th>Name</th>
                    <th data-hide="phone">Bemerkung</th>
                    <th ><span class="glyphicon glyphicon-check" aria-hidden="true"></span></th>
                </tr>
            </thead>
            <tbody>

                @foreach($songs as $song)
                <tr>
                    <td>{!! $song->number !!}</td>
                    <td>{!! $song->name !!}</td>
                    <td>{!! $song->annotation !!}</td>
                    <td>{!! Form::radio('song4', $song->id, false) !!}</td>
                </tr>
                @endforeach

            </tbody>
        </table>
    </div> </div>

{!! Form::label('song5', 'Lied 5'.$songsOrder[5]) !!} 
<div class="table-responsive">
    <div class="input-group">
        <input id="song5" class="form-control" type="text" placeholder="Suche">
        <span class="input-group-btn"><button class="btn btn-primary"
                type="button" data-toggle="collapse" data-target="#tableSong5"
                aria-expanded="false" aria-controls="collapseBeispiel">Liederliste</button>
        </span>

    </div>

    <div id="tableSong5" class="collapse">
        <table
            class="table table-striped table-hover footable toggle-default "
            data-filter="#song5">
            <thead>
                <tr>
                    <th>Nr</th>
                    <th>Name</th>
                    <th data-hide="phone">Bemerkung</th>
                    <th ><span class="glyphicon glyphicon-check" aria-hidden="true"></span></th>
                </tr>
            </thead>
            <tbody>

                @foreach($songs as $song)
                <tr>
                    <td>{!! $song->number !!}</td>
                    <td>{!! $song->name !!}</td>
                    <td>{!! $song->annotation !!}</td>
                    s
                    <td>{!! Form::radio('song5', $song->id, false) !!}</td>
                </tr>
                @endforeach

            </tbody>
        </table>
    </div> </div>

{!! Form::label('sacrament', 'Abendmahl') !!} 
{!! Form::text('sacrament', null, array('class'=>'form-control', 'placeholder'=>'Abendmahl')) !!}

{!! Form::label('song6', 'Lied 6'.$songsOrder[6]) !!} 
<div class="table-responsive">
    <div class="input-group">
        <input id="song1" class="form-control" type="text" placeholder="Suche">
        <span class="input-group-btn"><button class="btn btn-primary"
                type="button" data-toggle="collapse" data-target="#tableSong6"
                aria-expanded="false" aria-controls="collapseBeispiel">Liederliste</button>
        </span>

    </div>

    <div id="tableSong6" class="collapse">
        <table
            class="table table-striped table-hover footable toggle-default "
            data-filter="#song1">
            <thead>
                <tr>
                    <th>Nr</th>
                    <th>Name</th>
                    <th data-hide="phone">Bemerkung</th>
                    <th ><span class="glyphicon glyphicon-check" aria-hidden="true"></span></th>
                </tr>
            </thead>
            <tbody>

                @foreach($songs as $song)
                <tr>
                    <td>{!! $song->number !!}</td>
                    <td>{!! $song->name !!}</td>
                    <td>{!! $song->annotation !!}</td>
                    <td>{!! Form::radio('song6', $song->id, false) !!}</td>
                </tr>
                @endforeach

            </tbody>
        </table>
    </div> </div>

{!! Form::submit('Speichern', array('class'=>'btn btn-large btn-primary
btn-block'))!!} {!! Form::close() !!} {!! HTML::link('#', 'Zurück',
array('class' => 'btn btn-default',
'onClick="javascript:history.back();return false;"'))!!} @stop
