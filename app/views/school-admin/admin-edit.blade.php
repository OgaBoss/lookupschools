@extends('layouts.school-list-layout')
@section('content')
    <section class="content-header">
        <h1>
            <i class="fa fa-user"></i> Administrator's Profile
        </h1>
        <ol class="breadcrumb">
            <li><a href="/school/home"><i class="fa fa-home"></i> Home</a></li>
            <li class="active"><i class="fa fa-pencil"></i> Edit Profile</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="box box-default location">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-pencil"></i> Edit Details</h3>
                        <div class="box-tools pull-right">
                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <!-- general form elements -->
                        <!-- form start -->
                        {{Form::open(array('class' => 'edit_profile form-horizontal', 'route' => 'edit_profile'))}}
                            <div class="form-group">
                                <label  class="col-md-2 control-label">First Name <sup><i class="fa fa-asterisk"></i></sup></label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="first_name" value="{{Sentry::getUser()->first_name}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label  class="col-md-2 control-label">Last Name <sup><i class="fa fa-asterisk"></i></sup></label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="last_name" value="{{Sentry::getUser()->last_name}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label  class="col-md-2 control-label">Email <sup><i class="fa fa-asterisk"></i></sup></label>
                                <div class="col-md-6">
                                    <input type="email" class="form-control" name="email" value="{{Sentry::getUser()->email}}">
                                </div>
                            </div>
                            <div class="box-footer">
                                <button type="submit" class="btn btn-info">Save</button>
                            </div><!-- /.box-footer -->
                        {{Form::close()}}
                        <br>
                        <br>
                        {{Form::open(array('class' => 'change_password form-horizontal', 'route' => 'change_password'))}}
                            <div class="box-footer">
                                <h4><i class="fa fa-key"></i> Password Settings</h4>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Old Password <sup><i class="fa fa-asterisk"></i></sup></label>
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <input type="password" class="form-control" placeholder="Type in your old password" value="{{ $password }}">
                                            <span class="input-group-addon"><a href="#"><i class="fa fa-eye-slash"></i></a></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">New Password <sup><i class="fa fa-asterisk"></i></sup></label>
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <input type="password" class="form-control" name="new_pass" placeholder="Type in your new password">
                                            <span class="input-group-addon"><a href="#"><i class="fa fa-eye-slash"></i></a></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Password Conf <sup><i class="fa fa-asterisk"></i></sup></label>
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <input type="password" class="form-control" name="conf_pass" placeholder="Confirm new password">
                                            <span class="input-group-addon"><a href="#"><i class="fa fa-eye-slash"></i></a></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="box-footer">
                                <button type="submit" class="btn btn-info">Save</button>
                            </div><!-- /.box-footer -->
                        {{Form::close()}}
                        <br>
                        <br>
                        <div class="box-footer">
                            <h4><i class="fa fa-file-image-o"></i> Upload Profile Image</h4>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="box box-danger location">
                                        <div class="box-header with-border">
                                            <h3 class="box-title">Upload your profile image </h3>
                                            <div class="box-tools pull-right">
                                                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                            </div>
                                        </div><!-- /.box-header -->
                                        <div class="box-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <form id="uploadimage" enctype="multipart/form-data">
                                                        <div class="form-group">
                                                            <label for="exampleInputFile">File input</label>
                                                            <input type="file" id="image_upload" name="file" accept="image/*" data-url="/school/user_image_upload"/>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- /.box -->
                                </div>

                                <div class="col-md-4">
                                    <div id="color-overlay"></div>
                                    <div class="box box-success location">
                                        <div class="box-header with-border">
                                            <h3 class="box-title">School Logo</h3>
                                            <div class="box-tools pull-right">
                                                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                            </div>
                                        </div><!-- /.box-header -->
                                        <div class="box-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    @if(!Sentry::getUser()->photo_url)
                                                        {{ HTML::image('/img/user.png', 'User Image', array('class' => 'img-circle user_profile_pic', 'width' => '100', 'height' => '100')) }}
                                                    @else
                                                        {{ HTML::image(Sentry::getUser()->photo_url, 'User Image', array('class' => 'img-circle user_profile_pic', 'width' => '100', 'height' => '100')) }}
                                                    @endif
                                                </div>
                                                <div class="col-md-6 img-loader">
                                                    <img src="/css/ajax-loader.gif" class="pull-right">
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- /.box -->
                                </div>


                                <div class="col-md-4">
                                    <div class="box box-danger location">
                                        <div class="box-header with-border">
                                            <h3 class="box-title">School Logo Settings</h3>
                                            <div class="box-tools pull-right">
                                                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                            </div>
                                        </div><!-- /.box-header -->
                                        <div class="box-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <button type="submit" class="btn btn-info user_update_image">Update</button>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <button type="submit" class="btn btn-danger image-delete">Delete</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- /.box -->
                                </div>
                            </div>
                        </div>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div>
        </div>
    </section>
    {{ HTML::script('js/school-admin/school-admin-info.js'); }}
@stop