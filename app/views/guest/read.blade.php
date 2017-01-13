@extends('layouts.guest-dashboard-layout')
@section('content')
<!--BEGIN TITLE & BREADCRUMB PAGE-->
<div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
    <div class="page-header pull-left">
        <div class="page-title">
            Read Email Page</div>
    </div>
    <ol class="breadcrumb page-breadcrumb pull-right">
        <li><i class="fa fa-home"></i>&nbsp;<a href="/guest/home">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
        <li class="hidden"><a href="#">Inbox</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
        <li class="active">Inbox</li>
    </ol>
    <div class="clearfix">
    </div>
</div>

<section class="content">
    <div class="row">
        <div class="col-md-3">
            <div class="box box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">Folders</h3>
                    <div class="box-tools">
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body no-padding">
                    <ul class="nav nav-pills nav-stacked">
                        <li><a href="/guest/inbox"><i class="fa fa-inbox"></i> Inbox <span class="label label-primary pull-right">{{ count($messages) }}</span></a></li>
                        <li><a href="/guest/sent_message"><i class="fa fa-envelope-o"></i> Sent <span class="label label-primary pull-right">{{ count($message_sent) }}</span></a></li>
                    </ul>
                </div><!-- /.box-body -->
            </div><!-- /. box -->
        </div><!-- /.col -->
        <div class="col-md-9">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Read Mail</h3>
                    <div class="box-tools pull-right">
                        <a href="#" class="btn btn-box-tool" data-toggle="tooltip" title="Previous"><i class="fa fa-chevron-left"></i></a>
                        <a href="#" class="btn btn-box-tool" data-toggle="tooltip" title="Next"><i class="fa fa-chevron-right"></i></a>
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body no-padding">
                    <div class="mailbox-read-info">
                        <h3>{{ $message->subject }}</h3>
                        <h5>From: {{ $message->sender_identity }} <span class="mailbox-read-time pull-right">15 Feb. 2015 11:03 PM</span></h5>
                        <h5>To: {{ ucfirst($message->receiver_identity) }}</h5>
                    </div><!-- /.mailbox-read-info -->
                    <div class="mailbox-controls with-border text-center">
                        <div class="btn-group">
                            <button class="btn btn-default btn-sm" data-toggle="tooltip" title="Delete"><i class="fa fa-trash-o"></i></button>
                            <a href="/guest/{{ $message->school_slug }}/compose?receiver={{ $message->sender }}&subject={{ $message->subject }}" class="btn btn-default btn-sm" data-toggle="tooltip" title="Reply"><i class="fa fa-reply"></i></a>
                        </div><!-- /.btn-group -->
                    </div><!-- /.mailbox-controls -->
                    <div class="mailbox-read-message">
                        {{ $message->body }}
                    </div><!-- /.mailbox-read-message -->
                </div><!-- /.box-body -->
                <div class="box-footer">
                </div><!-- /.box-footer -->
            </div><!-- /. box -->
        </div><!-- /.col -->
    </div><!-- /.row -->
</section><!-- /.content -->
@stop
