@extends('layouts.pw-reset-layout')
@section('content')
    <div class="login-box">
        <div class="login-logo">
            <b>New Password</b>
        </div><!-- /.login-logo -->
        <div class="login-box-body">
            <p class="login-box-msg">Please type in a new password.</p>
            {{Form::open(array('route'=>'new_password_form_post'))}}
            <div class="form-group has-feedback">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                {{ Form::password('password', array('placeholder' => 'Password', 'class' => 'form-control input-sm')) }}
            </div>
            <div class="form-group has-feedback">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                {{ Form::password('password_conf', array('placeholder' => 'Password Confirmation', 'class' => 'form-control input-sm')) }}
                <input name="id" type="hidden" value="{{$id}}">
                <input name="reset_code" type="hidden" value="{{$reset_code}}">
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Reset</button>
                </div><!-- /.col -->
            </div>
            {{Form::close()}}
        </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->
@stop