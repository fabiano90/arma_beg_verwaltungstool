@extends('layouts.main')

@section('content')
<script type="text/javascript">
  
window.onload = function(){
  window.location.hash = "end";
}

</script>
<div class="row">
<div class="col-md-12">
    <div class="massage-head  container content-shadow content-box center-block" >
<h2 >  <span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> {!! $partner->username !!}
 </h2></div></div>
 </div>
<div >
    @foreach($messages as $message)
	
    <div class="row">
    	@if ($message->sender->id == $user->id)
     	   <div class="col-md-6"></div>
           <div class="col-md-6" >
            <div style="margin-left: 40px">
        		<div class="content-shadow content-box">
    		        
    		        	{!! $message->content !!}
    		        
    		    </div><div class = "massage-date">{!! date('d.m.Y H:i:s', strtotime($message->updated_at)) !!}</div>
             </div>   
    	   </div>

    	
    	@endif
    	@if ($message->receiver->id == $user->id)

    	<div class="col-md-6" style="margin-right: 40px">
    		<div class="content-shadow content-box">
		        	{!! $message->content !!}
		    </div><div class = "massage-date">{!! date('d.m.Y H:i:s', strtotime($message->updated_at)) !!}</div>
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
    {!! Form::close() !!}
@stop