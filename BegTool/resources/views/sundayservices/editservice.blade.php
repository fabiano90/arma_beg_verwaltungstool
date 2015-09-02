@extends('layouts.main') @section('content')

{!!HTML::script('js/editservice.js')!!}
{!! Form::model($sunday, array('url' => array('/sundayservices/editservice', $sunday->id))) !!} 

<h2 class="form-signup-heading">Lektordienst für den: 
    {!!	date('d.m.Y',$sunday->sermons->date)!!}</h2>

{!! Form::label('song1', 'Lied 1: Kein Lied gewählt'.$songsOrder[1], array('id' => 'song1')) !!} 
<div class="table-responsive">

	<div class="input-group">
        <span class="input-group-btn">
            <button class="btn btn-primary" id="searchButton1"
                            type="button" data-toggle="collapse" data-target="#tableSong1"
                            aria-expanded="false" aria-controls="collapseBeispiel">
                <span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span>
            </button>
        </span>
		<input id="song1" class="form-control" type="text" placeholder="Suche">
	</div>

	<div id="tableSong1" class="collapse">
		<table
			class="table table-striped table-hover footable toggle-default "
			data-filter="#song1">
			<thead>
				<tr>
                    <th><span class="glyphicon glyphicon-check" aria-hidden="true"></span></th>
					<th>Nr</th>
					<th>Name</th>
					<th data-hide="phone">Bemerkung</th>					
				</tr>
			</thead>
			<tbody>
				@foreach($songs as $song)
				<tr>
                    <td>
                        <label class="btn btn-primary">
                            <input class="radiosong1" type="radio" value="{!! $song->id !!}" songname="{!! $song->name !!}" name="song1" autocomplete="off"> Wählen
                        </label>
                    </td>                    
					<td>{!! $song->number !!}</td>
					<td>{!! $song->name !!}</td>
					<td>{!! $song->annotation !!}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div> 

</div>


{!! Form::label('psalm', 'Psalm') !!} 
{!! Form::text('psalm', null, array('class'=>'form-control', 'placeholder'=>'Psalm')) !!} 


{!! Form::label('song2', 'Lied 2: Kein Lied gewählt'.$songsOrder[2], array('id' => 'song2')) !!} 
<div class="table-responsive">

    <div class="input-group">
        <span class="input-group-btn">
            <button class="btn btn-primary" id="searchButton2"
                            type="button" data-toggle="collapse" data-target="#tableSong2"
                            aria-expanded="false" aria-controls="collapseBeispiel">
                <span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span>
            </button>
        </span>
        <input id="song2" class="form-control" type="text" placeholder="Suche">
    </div>

    <div id="tableSong2" class="collapse">
        <table
            class="table table-striped table-hover footable toggle-default "
            data-filter="#song2">
            <thead>
                <tr>
                    <th><span class="glyphicon glyphicon-check" aria-hidden="true"></span></th>
                    <th>Nr</th>
                    <th>Name</th>
                    <th data-hide="phone">Bemerkung</th>                    
                </tr>
            </thead>
            <tbody>
                @foreach($songs as $song)
                <tr>
                    <td>
                        <label class="btn btn-primary">
                            <input class="radiosong2" type="radio" value="{!! $song->id !!}" songname="{!! $song->name !!}" name="song2" autocomplete="off"> Wählen
                        </label>
                    </td>                      
                    <td>{!! $song->number !!}</td>
                    <td>{!! $song->name !!}</td>
                    <td>{!! $song->annotation !!}</td>                  
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>


{!! Form::label('biblereading', 'Schriftlesung') !!} 
{!! Form::text('biblereading', null, array('class'=>'form-control', 'placeholder'=>'Schriftlesung')) !!} 


{!! Form::label('song3', 'Lied 3: Kein Lied gewählt'.$songsOrder[3], array('id' => 'song3')) !!} 
<div class="table-responsive">

    <div class="input-group">
        <span class="input-group-btn">
            <button class="btn btn-primary" id="searchButton3"
                            type="button" data-toggle="collapse" data-target="#tableSong3"
                            aria-expanded="false" aria-controls="collapseBeispiel">
                <span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span>
            </button>
        </span>
        <input id="song3" class="form-control" type="text" placeholder="Suche">
    </div>

    <div id="tableSong3" class="collapse">
        <table
            class="table table-striped table-hover footable toggle-default "
            data-filter="#song3">
            <thead>
                <tr>
                    <th><span class="glyphicon glyphicon-check" aria-hidden="true"></span></th>
                    <th>Nr</th>
                    <th>Name</th>
                    <th data-hide="phone">Bemerkung</th>                    
                </tr>
            </thead>
            <tbody>
                @foreach($songs as $song)
                <tr>
                    <td>
                        <label class="btn btn-primary">
                            <input class="radiosong3" type="radio" value="{!! $song->id !!}" songname="{!! $song->name !!}" name="song3" autocomplete="off"> Wählen
                        </label>
                    </td>                      
                    <td>{!! $song->number !!}</td>
                    <td>{!! $song->name !!}</td>
                    <td>{!! $song->annotation !!}</td>                  
                </tr>
                @endforeach
            </tbody>
        </table>
    </div> 

</div>


{!! Form::label('comments', 'Abkündigungen') !!} 
{!! Form::text('comments', null, array('class'=>'form-control', 'placeholder'=>'Abkündigungen')) !!} 


{!! Form::label('song4', 'Lied 4 (Predigtlied): Kein Lied gewählt'.$songsOrder[4], array('id' => 'song4')) !!} 
<div class="table-responsive">

    <div class="input-group">
        <span class="input-group-btn">
            <button class="btn btn-primary" id="searchButton4"
                            type="button" data-toggle="collapse" data-target="#tableSong4"
                            aria-expanded="false" aria-controls="collapseBeispiel">
                <span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span>
            </button>
        </span>
        <input id="song4" class="form-control" type="text" placeholder="Suche">
    </div>

    <div id="tableSong4" class="collapse">
        <table
            class="table table-striped table-hover footable toggle-default "
            data-filter="#song4">
            <thead>
                <tr>
                    <th><span class="glyphicon glyphicon-check" aria-hidden="true"></span></th>
                    <th>Nr</th>
                    <th>Name</th>
                    <th data-hide="phone">Bemerkung</th>                    
                </tr>
            </thead>
            <tbody>
                @foreach($songs as $song)
                <tr>
                    <td>
                        <label class="btn btn-primary">
                            <input class="radiosong4" type="radio" value="{!! $song->id !!}" songname="{!! $song->name !!}" name="song4" autocomplete="off"> Wählen
                        </label>
                    </td>                      
                    <td>{!! $song->number !!}</td>
                    <td>{!! $song->name !!}</td>
                    <td>{!! $song->annotation !!}</td>              
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>

{!! Form::label('song5', 'Lied 5: Kein Lied gewählt'.$songsOrder[5], array('id' => 'song5')) !!} 
<div class="table-responsive">

    <div class="input-group">
        <span class="input-group-btn">
            <button class="btn btn-primary" id="searchButton5"
                            type="button" data-toggle="collapse" data-target="#tableSong5"
                            aria-expanded="false" aria-controls="collapseBeispiel">
                <span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span>
            </button>
        </span>
        <input id="song5" class="form-control" type="text" placeholder="Suche">
    </div>

    <div id="tableSong5" class="collapse">
        <table
            class="table table-striped table-hover footable toggle-default "
            data-filter="#song5">
            <thead>
                <tr>
                    <th><span class="glyphicon glyphicon-check" aria-hidden="true"></span></th>
                    <th>Nr</th>
                    <th>Name</th>
                    <th data-hide="phone">Bemerkung</th>                    
                </tr>
            </thead>
            <tbody>
                @foreach($songs as $song)
                <tr>
                    <td>
                        <label class="btn btn-primary">
                            <input class="radiosong5" type="radio" value="{!! $song->id !!}" songname="{!! $song->name !!}" name="song5" autocomplete="off"> Wählen
                        </label>
                    </td>                    
                    <td>{!! $song->number !!}</td>
                    <td>{!! $song->name !!}</td>
                    <td>{!! $song->annotation !!}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>


{!! Form::label('sacrament', 'Abendmahl') !!} 
{!! Form::text('sacrament', null, array('class'=>'form-control', 'placeholder'=>'Abendmahl')) !!}


{!! Form::label('song6', 'Lied 6: Kein Lied gewählt'.$songsOrder[6], array('id' => 'song6')) !!} 
<div class="table-responsive">

    <div class="input-group">
        <span class="input-group-btn">
            <button class="btn btn-primary" id="searchButton6"
                            type="button" data-toggle="collapse" data-target="#tableSong6"
                            aria-expanded="false" aria-controls="collapseBeispiel">
                <span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span>
            </button>
        </span>
        <input id="song6" class="form-control" type="text" placeholder="Suche">
    </div>

    <div id="tableSong6" class="collapse">
        <table
            class="table table-striped table-hover footable toggle-default "
            data-filter="#song1">
            <thead>
                <tr>
                    <th><span class="glyphicon glyphicon-check" aria-hidden="true"></span></th>
                    <th>Nr</th>
                    <th>Name</th>
                    <th data-hide="phone">Bemerkung</th>                    
                </tr>
            </thead>
            <tbody>
                @foreach($songs as $song)
                <tr>
                    <td>
                        <label class="btn btn-primary">
                            <input class="radiosong6" type="radio" value="{!! $song->id !!}" songname="{!! $song->name !!}" name="song6" autocomplete="off"> Wählen
                        </label>
                    </td>                      
                    <td>{!! $song->number !!}</td>
                    <td>{!! $song->name !!}</td>
                    <td>{!! $song->annotation !!}</td>                  
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>

{!! Form::submit('Speichern', array('class'=>'btn btn-large btn-primary btn-block'))!!} 
{!! Form::close() !!} 
@stop
