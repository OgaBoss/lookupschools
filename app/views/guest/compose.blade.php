@extends('layouts.guest-dashboard-layout')
@section('content')
    <div id="page-wrapper">
        <!--BEGIN TITLE & BREADCRUMB PAGE-->
        <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
            <div class="page-header pull-left">
                <div class="page-title">
                    Compose Message to School</div>
            </div>
            <ol class="breadcrumb page-breadcrumb pull-right">
                <li><i class="fa fa-home"></i>&nbsp;<a href="/guest/home">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                <li class="hidden"><a href="#">{{ ucfirst($school->name) }}</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                <li class="active">{{ ucfirst($school->name) }}</li>
            </ol>
            <div class="clearfix">
            </div>
        </div>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-3">
                    <a href="/school/inbox" class="btn btn-primary btn-block margin-bottom">Back to Inbox</a>
                    <div class="box box-solid">
                        <div class="box-header with-border">
                            <h3 class="box-title">Folders</h3>
                        </div>
                        <div class="box-body no-padding">
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="/guest/inbox"><i class="fa fa-inbox"></i> Inbox <span class="label label-primary pull-right">{{ count($message) }}</span></a></li>
                                <li><a href="/guest/sent_message"><i class="fa fa-envelope-o"></i> Sent <span class="label label-primary pull-right">{{ count($message_r) }}</span></a></li>
                            </ul>
                        </div><!-- /.box-body -->
                    </div><!-- /. box -->

                </div><!-- /.col -->

                <div class="col-md-9">
                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title">Compose Message to <small>{{ucfirst($school->name)}}</small></h3>
                            <!-- tools box -->
                            <!-- tools box -->
                            <div class="pull-right box-tools">
                                <i class="fa fa-spin fa-spinner" style="font-size: 24px; color: green; display: none;"></i>
                            </div><!-- /. tools -->

                        </div><!-- /.box-header -->
                        {{Form::open(array('route'=>'post_compose', 'class'=>'compose'))}}
                            <div class="box-body pad">
                                <div class="form-group">
                                    <label for="">To:</label>
                                    <input class="form-control to" placeholder="To:" value="{{ isset($to)?$to:$msg_to }}" name="receiver" disabled/>
                                    <input id="slug" type="hidden" value="{{ $school->slug }}" name="slug">
                                    <input id="id" type="hidden" value="{{ $school_owner_id }}" name="id">
                                </div>
                                <div class="form-group">
                                    <label for="">Subject:</label>
                                    <input class="form-control subject" placeholder="Subject:" name="subject" value="{{isset($subject)?$subject:""}}" {{ isset($subject)?'disabled':"" }}/>
                                </div>
                                <textarea id="editor1" name="body" rows="10" cols="80" placeholder="Type your message here">
                                </textarea>
                            </div>
                            <div class="box-footer">
                                <div class="pull-right">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-envelope-o"></i> Send</button>
                                </div>
                            </div><!-- /.box-footer -->
                        {{Form::close()}}
                    </div>
                </div><!-- /.row -->
            </div>
        </section><!-- /.content -->
    </div>
    {{ HTML::script('js/guest/messaging.js'); }}
@stop