@extends('layouts.school-dashboard-layout')
@section('content')
    <section class="content-header">
        <h1>
            Mailbox
            <small>13 new messages</small>
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
                <a href="/school/inbox" class="btn btn-primary btn-block margin-bottom">Back to Inbox</a>
                <div class="box box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">Folders</h3>
                        <div class="box-tools">
                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="box-body no-padding">
                        <ul class="nav nav-pills nav-stacked">
                            <li><a href="/school/inbox"><i class="fa fa-inbox"></i> Inbox <span class="label label-primary pull-right inbox-msg-count">1</span></a></li>
                            <li><a href="/school/sent_message"><i class="fa fa-envelope-o"></i> Sent</a></li>
                        </ul>
                    </div><!-- /.box-body -->
                </div><!-- /. box -->

            </div><!-- /.col -->

            <div class="col-md-9">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Compose Message</h3>
                        <!-- tools box -->
                        <div class="pull-right box-tools">
                            <i class="fa fa-spin fa-spinner" style="font-size: 24px; color: green; display: none;"></i>
                        </div><!-- /. tools -->

                    </div><!-- /.box-header -->
                    <div class="box-body pad">
                        {{Form::open(array('route'=>'school_post_compose', 'class'=>'compose'))}}
                            <div class="form-group">
                                <label for="">To:</label>
                                <input class="form-control to" placeholder="To:" value="{{ isset($to)?$to:'Admin' }}" name="receiver" disabled/>
                                <input id="slug" type="hidden" value="{{ $school->slug }}" name="slug">
                                <input id="id" type="hidden" value="{{ isset($id)?$id:1 }}" name="id">
                            </div>
                            <div class="form-group">
                                <label for="">Subject:</label>
                                <input class="form-control subject" placeholder="Subject:" name="subject" value="{{ isset($subject)?$subject:"" }}"/>
                            </div>
                            <textarea id="editor1" name="editor1" rows="10" cols="80">

                            </textarea>
                            <div class="box-footer">
                                <div class="pull-right">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-envelope-o"></i> Send</button>
                                </div>
                            </div><!-- /.box-footer -->
                        {{Form::close()}}
                    </div>

                </div>
            </div>
        </div><!-- /.row -->
    </section><!-- /.content -->
    {{ HTML::script('js/school-admin/messaging.js'); }}
@stop