@extends('layouts.school-list-layout')
@section('content')
        <!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Read Mail
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Mailbox</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-3">
            <a href="compose.html" class="btn btn-primary btn-block margin-bottom">Compose</a>
            <div class="box box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">Folders</h3>
                    <div class="box-tools">
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body no-padding">
                    <ul class="nav nav-pills nav-stacked">
                        <li><a href="/school/inbox"><i class="fa fa-inbox"></i> Inbox <span class="label label-primary pull-right inbox-msg-count"></span></a></li>
                        <li><a href="/school/sent_message"><i class="fa fa-envelope-o"></i> Sent</a></li>
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
                        <h5>Message addressed to {{ ucfirst($message->school_slug ) }}</h5>
                        <h5>From: {{ $message->sender_identity }} <span class="mailbox-read-time pull-right">15 Feb. 2015 11:03 PM</span></h5>
                    </div><!-- /.mailbox-read-info -->
                    <div class="mailbox-controls with-border text-center">
                        <div class="btn-group">
                            <button class="btn btn-default btn-sm" data-toggle="tooltip" title="Delete"><i class="fa fa-trash-o"></i></button>
                            <a href="/school/{{ $message->school_slug }}/compose?receiver={{ $message->sender }}&subject={{ $message->subject }}" class="btn btn-default btn-sm" data-toggle="tooltip" title="Reply"><i class="fa fa-reply"></i></a>
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