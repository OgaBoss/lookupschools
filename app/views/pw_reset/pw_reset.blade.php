@extends('layouts.pw-reset-layout')
@section('content')
    <div class="login-box">
        <div class="login-logo">
            <b>Password Reset</b>
        </div><!-- /.login-logo -->
        <div class="login-box-body">
            <p class="login-box-msg">Please type in your account email.</p>
            {{Form::open(array('route'=>'pwreset_form_post'))}}
            <div class="form-group has-feedback">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                {{ Form::text('email', Input::old('email'),array('placeholder' => 'Email Address', 'class' => 'form-control input-sm')) }}
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