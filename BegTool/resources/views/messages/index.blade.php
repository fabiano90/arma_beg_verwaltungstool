@extends('layouts.main')

@section('content')
<script type="text/javascript">
  
window.onload = function(){
  window.location.hash = "end";
}
</script> 
<div class="row row-offcanvas row-offcanvas-left">

            <div class="col-xs-12 col-sm-9">
              <p class="pull-left visible-xs">
                <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Personen</button>
              </p>
<div class="jumbotron">
    <div class="row">
         <table data-page-size="5" class=" table-striped table-hover footable" data-filter="#filter">
                     
                    <thead>
                        <tr>
                            <th data-sort-initial="true">Datum</th>
                            <th>Dienst</th>
                            <th>Bearbeiten</th>
                        </tr>
                    </thead>
                    <tbody>



        <div class="col-md-12">
            <div class=" container content-shadow content-box center-block" >
                <h2 ><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> {!! $partner->username !!}</h2>
            </div>
        </div>
    </div>
    <div >
        @foreach($messages as $message)
        
        <div class="row">
            @if ($message->sender->id == $user->id)
               <div class="col-md-6"></div>
               <div class="col-md-6" >
                <div style="margin-left: 20%">
                    <div class="arrow_box_left">
                        
                            {!! $message->content !!}
                        
                    </div>
                    <div class = "massage-date">{!! date('d.m. H:i:s', strtotime($message->updated_at)) !!}</div>
                 </div>   
               </div>

            
            @endif
            @if ($message->receiver->id == $user->id)

            <div class="col-md-6">
                <div style="margin-right: 20%">
                    <div class="arrow_box_right">
                            {!! $message->content !!}
                    </div>
                    <div class = "massage-date">{!! date('d.m. H:i:s', strtotime($message->updated_at)) !!}</div>
                </div>
            </div>
            <div class="col-md-6"></div>
            @endif
        </div>

        
        @endforeach
        </div>
        <div id="end"></div>
         
        {!! Form::open(array('url'=>'messages/new/'.$partner->id, 'class'=>'form-signup')) !!}
        {!! Form::label('content', 'Nachricht') !!}
        {!! Form::textarea('content', null, array('class'=>'form-control', 'placeholder'=>'Nachricht')) !!}
        <br/>
        {!! Form::submit('Senden', array('class'=>'btn btn-large btn-primary pull-right'))!!}
        {!! Form::close() !!}</div>
              <div class="row">
                <div class="col-xs-6 col-lg-4">

                </div><!--/.col-xs-6.col-lg-4-->
              </div><!--/row-->
            </div><!--/.col-xs-12.col-sm-9-->

            <div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar">
              <div class="list-group">
                @foreach($users as $partner)
                <a href="#" class="list-group-item">{!!$partner->username!!}</a>
                   
                @endforeach
              </div>
            </div><!--/.sidebar-offcanvas-->
      </div><!--/row-->
      </tbody>
</table>
@stop