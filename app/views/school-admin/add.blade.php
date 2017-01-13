@extends('layouts.school-list-layout')
@section('content')

    <section class="content-header">
        <h1>
            Add School
        </h1>
        <ol class="breadcrumb">
            <li><a href="/school/home"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Add School</li>
        </ol>
    </section>
    <section class="content">
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">Name and Location</h3>
                <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                </div>
            </div><!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <!-- general form elements -->
                        <!-- form start -->
                        {{Form::open(array('class' => 'add-form form-horizontal', 'route' => 'post_school_form'))}}
                        <div class="box-body">
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">School Name <sup><i class="fa fa-asterisk"></i></sup></label>
                                <div class="col-sm-6">
                                    {{ Form::text('name', Input::old('name'), array('placeholder' => 'School Name', 'class' => 'form-control input-sm', 'id' => 'school-name')) }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">State <sup><i class="fa fa-asterisk"></i></sup></label>
                                <div class="col-md-6">
                                    <select class="form-control select2 " id="state-dropdown" name="state">
                                        <option></option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">Local Government <sup><i class="fa fa-asterisk"></i></sup></label>
                                <div class="col-md-6 ">
                                    <select class="form-control select2" id="area-dropdown" name="lga">
                                        <option></option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-2 control-label">School Address <sup><i class="fa fa-asterisk"></i> <i class="fa fa-question-circle explain" title=""></i> </sup></label>
                                <div class="col-sm-6">
                                    {{ Form::text('address', Input::old('address'),array('placeholder' => '.e.g No 4, Funsho Link, Alara street, Yaba', 'class' => 'form-control input-sm', 'id' => 'school-address')) }}
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">School Type <sup><i class="fa fa-asterisk"></i></sup></label>
                                <div class="col-sm-6">
                                    {{ Form::select('school_type', array('preschool' => 'Preschool', 'primary' => 'Primary School', 'secondary' => 'Secondary School', 'tertiary' => 'Tertiary', 'vocation' => 'Vocation', ), 'Select School Type', ['class' =>
                                     'select2 form-control input-sm']) }}
                                </div>
                            </div>


                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-2 control-label">School Area <sup><i class="fa fa-asterisk"></i></sup> </label>
                                <div class="col-sm-6">
                                    {{ Form::text('area', Input::old('area'),array('placeholder' => '.e.g Yaba, Ikoyi ,.....', 'class' => 'form-control input-sm', 'id' => 'school-address')) }}
                                </div>
                            </div>
                        </div><!-- /.box-body -->
                        <div class="box-footer">
                            <button type="submit" class="btn btn-info">Save</button>
                        </div><!-- /.box-footer -->
                        {{Form::close()}}
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.box-body -->
            <div class="box-footer">
                Please provide <span style="color: #005983">good and accurate Information</span>, for a better search.
            </div>
        </div><!-- /.box -->
    </section>
@stop