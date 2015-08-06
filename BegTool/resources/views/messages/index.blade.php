@extends('layouts.main')

@section('content')
<script type="text/javascript">
  
window.onload = function(){
  window.location.hash = "end";
}

</script>
<div class="row header">
<div class="col-md-12">
<h2>Nachricht an {!! $partner->username !!}
 </h2></div>
 </div>
<div >
    @foreach($messages as $message)
	
    <div class="row">
    	@if ($message->sender->id == $user->id)
    	<div class="col-md-6"></div>

    	<div class="col-md-5" style="margin-left: 40px">
    		<div class="panel panel-default">
		        <div class="panel-heading">
		            {!! $message->sender->username !!}: {!! date('d.m.Y H:i:s', strtotime($message->updated_at)) !!}
		        </div>
		        <div class="panel-body">
		        	{!! $message->content !!}
		        </div>
		    </div>
    	</div>
    	<div class="col-md-6"></div>
    	
    	@endif
    	@if ($message->receiver->id == $user->id)

    	<div class="col-md-6" style="margin-left: 40px">
    		<div class="panel panel-default">
		        <div class="panel-heading">
		            Von: {!! $message->sender->username !!}: {!! date('d.m.Y H:i:s', strtotime($message->updated_at)) !!}
		        </div>
		        <div class="panel-body">
		        	{!! $message->content !!}
		        </div>
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
    {!! Form::text('content', null, array('class'=>'form-control', 'placeholder'=>'Nachricht')) !!}
    <br/>
    {!! Form::submit('Speichern', array('class'=>'btn btn-large btn-primary btn-block'))!!}
    {!! Form::close() !!}
@stop