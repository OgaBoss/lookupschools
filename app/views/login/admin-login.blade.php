@extends('layouts.login-layout')
@section('content')
    <div class="login-box">
        <div class="login-logo">
            <b>Admin Login</b>
        </div><!-- /.login-logo -->
        <div class="login-box-body">
            <p class="login-box-msg">Sign into your dashboard </p>
            {{Form::open(array('route'=>'login_form_post'))}}
            <div class="form-group has-feedback">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                {{ Form::text('email', Input::old('email'),array('placeholder' => 'Email Address', 'class' => 'form-control input-sm')) }}
            </div>
            <div class="form-group has-feedback">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                {{ Form::password('password', array('placeholder' => 'Password', 'class' => 'form-control input-sm')) }}
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                </div><!-- /.col -->
            </div>
            {{Form::close()}} <br>
        </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->
@stop