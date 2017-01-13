@extends('layouts.school-list-layout')
@section('content')
    <section class="content-header">
        <h1>
            Sent Messages
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/school/home"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Sent Messages</li>
        </ol>
    </section>

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
                                <li ><a href="/school/inbox"><i class="fa fa-inbox"></i> Inbox
                                            <span class="label label-primary pull-right inbox-msg-count"></span>
                                    </a></li>
                                <li class="active"><a href="/school/sent_message"><i class="fa fa-envelope-o"></i> Sent <span class="label label-primary pull-right">{{ count($messages) }}</span></a></li>
                            </ul>
                        </div><!-- /.box-body -->
                    </div><!-- /. box -->

                </div><!-- /.col -->
                <div class="col-md-9">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                        </div><!-- /.box-header -->
                        <div class="box-body no-padding">
                            <div class="mailbox-controls">
                                <!-- Check all button -->
                                <div class="btn-group">
                                    <button class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></button>
                                    <button class="btn btn-default btn-sm"><i class="fa fa-reply"></i></button>
                                </div><!-- /.btn-group -->
                            </div>
                            <div class="table-responsive mailbox-messages">
                                <table class="table table-hover table-striped">
                                    <tbody>
                                    @forelse($messages as $msg)
                                        <tr>
                                            <td class="mailbox-star"><a href="#"><i class="fa fa-star text-yellow"></i></a></td>
                                            <td class="mailbox-name"><a href="/school/message/{{ $msg->id }}">{{ ucfirst($msg->receiver_identity) }}</a></td>
                                            <td class="mailbox-subject"><b>{{ $msg->subject }}</b></td>
                                            <td class="mailbox-date">{{ date("F jS, Y",strtotime($msg->created_at)) }}</td>
                                        </tr>
                                    @empty
                                        <td><input type="checkbox" /></td>
                                        <td class="mailbox-name"><a href="#">Empty Inbox</a></td>
                                    @endforelse
                                    </tbody>
                                </table><!-- /.table -->
                            </div><!-- /.mail-box-messages -->
                        </div><!-- /.box-body -->
                    </div><!-- /. box -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </section><!-- /.content -->

    </div>
@stop