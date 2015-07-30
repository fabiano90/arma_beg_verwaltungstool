@extends('layouts.main')

@section('content')
    <h2>Posts vom Benutzer</h2>
    @foreach($posts as $post)
    <div class="panel panel-default">
        <div class="panel-heading">
            {!! $post->title !!}
        </div>
        <div class="panel-body">
            {!! $post->content !!}<br/>
            {!! $post->link !!}
        </div>
    </div>
    @endforeach
@stop
