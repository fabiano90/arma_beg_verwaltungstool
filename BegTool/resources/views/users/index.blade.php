@extends('layouts.main') 
@section('messages')
    @if($newMessages>'0')
        <span class="label label-danger message-cound">{!!$newMessages." neu"!!}</span>
    @endif 
@stop

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
            Hallo {!!$user->username!!}, hier sind deine nächsten Dienste:
            <div class="table-responsive">
                <table data-page-size="5" class=" table-striped table-hover footable" data-filter="#filter">
                     
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
                            <td data-type="numeric" data-value='{!! $kigo->date !!}'>{!! date('d.m.Y', $kigo->date) !!}</td>
                            <td>Kigo</td>
                            
                        </tr>
                        @endforeach 
                        @foreach($lektors as $lektor)
                        <tr>
                            <td data-type="numeric" data-value='{!! $lektor->sermons->date !!}'>{!! date('d.m.Y', $lektor->sermons->date) !!}</td>
                            <td>Leitung</td>
                            
                        </tr>
                        @endforeach 
                        @foreach($sermons as $sermon)
                        <tr>
                            <td data-type="numeric" data-value='{!! $sermon->date !!}'>{!! date('d.m.Y', $sermon->date) !!}</td>
                            <td>Predigt</td>
                            
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
@stop
@section('content')
<div class="row">
    <div class="col-md-4">
        <a href="/messages/chat/0#end">
            <div class="content-shadow content-box text-center">
                    <h2><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>@yield('messages') Nachrichten </h2>
            </div>
        </a>
    </div>
    <div class="col-md-4">
        <a href="/sundays">
            <div class="content-shadow content-box text-center">
            <h2><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>  Übersicht</h2>
        </div></a>
    </div>
    <div class="col-md-4">
      <a href="/songs">
        <div class="content-shadow content-box text-center">
                   <h2><span class="glyphicon glyphicon-music text-center" aria-hidden="true"></span>  Lieder</h2>
           
        </div></a>
    </div>

</div>





@stop