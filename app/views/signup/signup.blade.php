@extends('layouts.signup-layout')
@section('content')
    <div class="row" id="sign-up">
        <div class="col-md-4 col-md-offset-2">
            <div class="register-box">
                <div class="register-logo">
                    <b>School Sign Up</b>
                </div>
                <div class="register-box-body school-up">
                    <p class="login-box-msg">Register a new Account</p>
                    {{Form::open(array('route'=>'signup_form_post'))}}
                    <div class="form-group has-feedback">
                        {{ Form::text('firstname', Input::old('firstname'),array('placeholder' => 'First Name', 'class' => 'form-control')) }}
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        {{Form::text('lastname', Input::old('lastname'), array('placeholder' => 'Last name', 'class' => 'form-control'))}}
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        {{Form::email('email', Input::old('email'), array('placeholder' => 'Email Address', 'class' => 'form-control'))}}
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        {{Form::password('password', array('placeholder' => 'Password', 'class' => 'form-control'))}}
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        {{Form::password('passwordconf', array('placeholder' => 'Retype password', 'class' => 'form-control'))}}
                        <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
                    </div>
                    <div class="row">
                        <div class="col-xs-12   ">
                            <button type="submit" class="btn btn-primary btn-block btn-flat">Sign Up</button>
                        </div><!-- /.col -->
                    </div>
                    {{Form::close()}} <br>
                    <div class="social-auth-links text-center">
                        <p>- OR -</p>
                        <a href="facebook?type=user" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign up using Facebook</a>
                        <a href="google?type=user" id="gglog" class="btn btn-block btn-social btn-google-plus btn-flat"><i class="fa fa-google-plus"></i> Sign up using Google+</a>
                    </div><!-- /.social-auth-links -->
                    <a href="/login" class="text-center">Already have an account?</a>

                </div><!-- /.form-box -->
            </div><!-- /.register-box -->
        </div>
        <div class="col-md-4">
            <div class="register-box">
                <div class="register-logo">
                    <b>Guest Sign Up</b>
                </div>
                <div class="register-box-body guest-up">
                    <p class="login-box-msg">Register a new Account</p>
                    {{Form::open(array('route'=>'guest_signup_form_post'))}}
                    <div class="form-group has-feedback">
                        {{ Form::text('firstname', Input::old('firstname'),array('placeholder' => 'First Name', 'class' => 'form-control')) }}
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        {{Form::text('lastname', Input::old('lastname'), array('placeholder' => 'Last name', 'class' => 'form-control'))}}
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        {{Form::email('email', Input::old('email'), array('placeholder' => 'Email Address', 'class' => 'form-control'))}}
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        {{Form::password('password', array('placeholder' => 'Password', 'class' => 'form-control'))}}
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        {{Form::password('passwordconf', array('placeholder' => 'Retype password', 'class' => 'form-control'))}}
                        <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
                    </div>
                    <div class="row">
                        <div class="col-xs-12   ">
                            <button type="submit" class="btn btn-primary btn-block btn-flat">Sign Up</button>
                        </div><!-- /.col -->
                    </div>
                    {{Form::close()}} <br>
                    <div class="social-auth-links text-center">
                        <p>- OR -</p>
                        <a href="facebook?type=guest" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign up using Facebook</a>
                        <a href="google?type=guest" class="btn btn-block btn-social btn-google-plus btn-flat"><i class="fa fa-google-plus"></i> Sign up using Google+</a>
                    </div><!-- /.social-auth-links -->
                    <a href="/login" class="text-center">Already have an account?</a>

                </div><!-- /.form-box -->
            </div><!-- /.register-box -->
        </div>
    </div>



@stop