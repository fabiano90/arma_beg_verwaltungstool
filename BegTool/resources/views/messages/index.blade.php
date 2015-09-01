@extends('layouts.main') @section('content')
<script type="text/javascript">
    window.onload = function() {
        window.location.hash = "end";
        $('.user-list').scrollToFixed();
    }
</script>
<div class="row row-offcanvas row-offcanvas-left">
    <div class="col-xs-6 col-sm-3 sidebar-offcanvas user-list" id="sidebar">
        <div class="list-group">
            @foreach($users as $userlist)
                @if ($userlist->id == $partner->id)
                    <a href='{!!"/messages/chat/".$userlist->id."#end"!!}' class="list-group-item active">{!!$userlist->username!!}</a>
                @else
                    <a href='{!!"/messages/chat/".$userlist->id."#end"!!}' class="list-group-item">{!!$userlist->username!!}
                        <!--{!!$i=0!!}-->
                        @foreach($allmessages as $message)
                                @if ($message->receiver_id == $user->id)
                                    @if ($message->sender_id == $userlist->id)
                                            <!--{!!$i+=$message->visited!!}-->
                                    @endif
                                @endif
                        @endforeach
                        @if($i!=0)
                            ({!!$i!!})
                        @endif
                    </a>
                @endif
            @endforeach
        </div>
    </div>
    <div class="col-xs-12 col-sm-9">

<p class="pull-left visible-xs user-list">
                                <a href="#"><button type="button" class="btn btn-primary btn-xs gedreht" data-toggle="offcanvas">Personen</button></a>
                            </p>
        <div>
            <table class="massage-content">
                <thead>
                    <tr>
                        <th>
                            
                            <span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> {!! $partner->username !!}
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <div>
                                @foreach($messages as $message)
                                <div class="row">
                                    @if ($message->sender->id == $user->id)
                                    <div class="col-md-6"></div>
                                    <div class="col-md-6">
                                        <div style="margin-left: 20%">
                                            <div class="arrow_box_left">
                                                {!! $message->content !!}
                                            </div>
                                            <div class="massage-date">{!! date('d.m. H:i:s', strtotime($message->updated_at)) !!}</div>
                                        </div>
                                    </div>
                                    @endif @if ($message->receiver->id == $user->id)
                                    <div class="col-md-6">
                                        <div style="margin-right: 20%">
                                            <div class="arrow_box_right">
                                                {!! $message->content !!}
                                            </div>
                                            <div class="massage-date">{!! date('d.m. H:i:s', strtotime($message->updated_at)) !!}</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6"></div>
                                    @endif
                                </div>
                                @endforeach
                            </div>
                            <div id="end"></div>
                            @if ($partner->id == '0')
                            @else
                            {!! Form::open(array('url'=>'messages/new/'.$partner->id, 'class'=>'form-signup')) !!} 
                            {!! Form::label('content', 'Nachricht') !!} 
                            {!! Form::textarea('content', null, array('class'=>'form-control', 'placeholder'=>'Nachricht')) !!}
                            {!! Form::submit('Senden', array('class'=>'btn btn-large btn-primary pull-right'))!!} {!! Form::close() !!}
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="row">
            <div class="col-xs-6 col-lg-4">

            </div>
            <!--/.col-xs-6.col-lg-4-->
        </div>
        <!--/row-->
    </div>
    <!--/.col-xs-12.col-sm-9-->


    <!--/.sidebar-offcanvas-->
</div>
<!--/row-->

@stop