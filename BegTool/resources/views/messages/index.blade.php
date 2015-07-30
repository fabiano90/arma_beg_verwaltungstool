@extends('layouts.main')

@section('content')
    <h2>Messages</h2>
    {!! Form::open(array('url'=>'messages/index', 'class'=>'form-signup')) !!}
    {!! Form::label('content', 'Inhalt') !!}
    {!! Form::textarea('content', null, array('class'=>'form-control', 'placeholder'=>'Inhalt')) !!}
    <br/>
    {!! Form::submit('Speichern', array('class'=>'btn btn-large btn-primary btn-block'))!!}
    <br/>
    {!! Form::close() !!}

    @foreach($messages as $message)
    <div class="row">
    	@if ($message->sender->id == $user->id)
    	<div class="col-md-6">
    		<div class="panel panel-default">
		        <div class="panel-heading">
		            Von: {!! $message->sender->username !!} zu: {!! $message->receiver->username !!} am {!! date('d.m.Y H:i:s', strtotime($message->updated_at)) !!}
		        </div>
		        <div class="panel-body">
		        	{!! $message->content !!}
		        </div>
		    </div>
    	</div>
    	<div class="col-md-6"></div>
    	@endif
    	@if ($message->receiver->id == $user->id)
    	<div class="col-md-6"></div>
    	<div class="col-md-6">
    		<div class="panel panel-default">
		        <div class="panel-heading">
		            Von: {!! $message->sender->username !!} zu: {!! $message->receiver->username !!} am {!! date('d.m.Y H:i:s', strtotime($message->updated_at)) !!}
		        </div>
		        <div class="panel-body">
		        	{!! $message->content !!}
		        </div>
		    </div>
    	</div>
    	@endif
    </div>

    
    @endforeach
@stop