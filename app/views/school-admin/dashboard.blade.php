@extends('layouts.school-dashboard-layout')
@section('content')
    <link rel="stylesheet" href="/css/form-edit.css">
    <section class="content-header">
        <h1>
            School Information
        </h1>
        <ol class="breadcrumb">
            <li><a href="/school/home"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Basic Information</li>
        </ol>
    </section>
    <section class="content">
        <!--Basic Information -->
        <div class="row">
            <div class="col-md-12">
                <div class="box box-default location">
                    <div class="box-header with-border">
                        <h3 class="box-title">Name and Location</h3>
                        <div class="box-tools pull-right">
                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <!-- general form elements -->
                        <!-- form start -->
                        {{Form::open(array('class' => 'basic-info form-horizontal', 'route' => 'basic_info'))}}
                            <div class="form-group">
                                <label  class="col-md-2 control-label">School Full-Name <sup><i class="fa fa-asterisk"></i></sup></label>
                                <div class="col-md-6">
                                    {{ Form::text('name', $school->name,array('placeholder' => 'School Name', 'class' => 'form-control hide-form', 'id' => 'school-name', 'disabled' => 'disabled')) }}
                                </div>
                                <div class="col-md-4 ">
                                    <button type="submit" class="btn btn-warning pull-right form-edit">Edit</button>
                                </div>
                            </div>
                            <div class="form-group">
                                <label  class="col-md-2 control-label">School Short-Name </label>
                                <div class="col-md-6">
                                    {{ Form::text('sname', $school['short_name'],array('placeholder' => 'e.g ISL', 'class' => 'form-control hide-form', 'id' => 'school-name', 'disabled' => 'disabled')) }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">State <sup><i class="fa fa-asterisk"></i></sup></label>
                                <div class="col-md-6">
                                    <select class="form-control select2 hide-form" id="state-dropdown" name="state" title="This is my image's tooltip message!" disabled>
                                        <option value="{{ $school->state }}" selected="selected">{{ $school->state}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">Local Government <sup><i class="fa fa-asterisk"></i></sup></label>
                                <div class="col-md-6 ">
                                    <select class="form-control select2 hide-form" id="area-dropdown" name="lga" disabled>
                                        <option value="{{ $school->local_gov }}" selected="selected">{{ $school->local_gov}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">School Address <sup><i class="fa fa-asterisk"></i> <i class="fa fa-question-circle explain" title=""></i> </sup></label>
                                <div class="col-md-6">
                                    {{ Form::text('address', $school->address,array('placeholder' => '.e.g No 4, Funsho Link, Alara street, Yaba', 'class' => 'form-control hide-form','id' => 'school-address', 'disabled' => 'disabled')) }}
                                    <input type="hidden" value="{{ $school->id }}" name="id" id="id">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">School Area <sup><i class="fa fa-asterisk"></i></sup></label>
                                <div class="col-md-6">
                                    {{ Form::text('area', $school->area,array('placeholder' => '.e.g Yaba, Ikoyi ,.....', 'class' => 'form-control hide-form', 'id' => 'school-address', 'disabled' => 'disabled')) }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">Longitude</label>
                                <div class="col-md-6">
                                    {{ Form::text('lng', $school['lng'],array('placeholder' => '', 'class' => 'form-control hide-form', 'id' => 'school-address', 'disabled' => 'disabled')) }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">FaceBook Page</label>
                                <div class="col-md-6">
                                    {{ Form::text('fbpage', $school['facebook_page'],array('placeholder' => 'https://www.facebook.com/lagoslaravelmeetups/', 'class' => 'form-control hide-form', 'id' => 'school-address', 'disabled' => 'disabled')) }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">Latitude</label>
                                <div class="col-md-6">
                                    {{ Form::text('lat', $school['lat'],array('placeholder' => '', 'class' => 'form-control hide-form', 'id' => 'school-address', 'disabled' => 'disabled')) }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-md-2 control-label">School Type <sup><i class="fa fa-asterisk"></i></sup></label>
                                <div class="col-md-6">
                                    {{ Form::select('school_type', array('preschool' => 'Preschool', 'primary' => 'Primary School', 'secondary' => 'Secondary School', 'tertiary' => 'Tertiary', 'vocation' => 'Vocation', ), $school->school_type, ['class' => 'select2 form-control input-sm sch-typ hide-form', 'disabled' => 'disabled']) }}
                                </div>
                            </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-info btn-save" style="display: none;">Save</button>
                        </div><!-- /.box-footer -->
                        {{Form::close()}}
                    </div><!-- /.box-body -->
                    <div class="box-footer">
                        The fields with the <span style="color: red">asterisks</span> are <span style="color: red">compulsory</span>. <br>
                        Please provide <span style="color: #005983">good and accurate Information</span>, for a better search.
                    </div>
                </div><!-- /.box -->
            </div>
        </div>

        <!-- Logo Upload -->
        <div class="row">
            <div class="col-md-4">
                <div class="box box-danger location">
                    <div class="box-header with-border">
                        <h3 class="box-title">Upload School Logo</h3>
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
                                        <input type="file" id="image_upload" name="file" accept="image/*" data-url="/school/logo_upload" />
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
                                @if(count($imageUrl) > 0)
                                    @foreach($imageUrl as $url)
                                        <img src="{{ $url['openURL'] }}" height="120" width="120" id="school_logo">
                                    @endforeach
                                @else
                                    <img src="/img/school-icon.png" height="120" width="120" id="school_logo">
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
                                        <button type="submit" class="btn btn-info image-update">Update</button>
                                    </div>
                                    <div class="col-md-3">
                                        <button type="submit" class="btn btn-danger logo-delete">Delete</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- /.box -->
            </div>
        </div>
    </section>
    {{ HTML::script('js/school-admin/school-admin-info.js'); }}
@stop