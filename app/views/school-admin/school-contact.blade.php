@extends('layouts.school-dashboard-layout')
@section('content')
    <section class="content-header">
        <h1>
            School Data
        </h1>
        <ol class="breadcrumb">
            <li><a href="/school/home"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">School Contacts</li>
        </ol>
    </section>
    <section class="content">
        <!-- Logo Upload -->
        <div class="row">
            <div class="col-md-12">
                <div class="box box-default location">
                    <div class="box-header with-border">
                        <h3 class="box-title">School Contacts</h3>
                        <div class="box-tools pull-right">
                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        {{ Form::open(array('class' => 'contact form-horizontal', 'route' => 'post_school_contact')) }}
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Phone 1 <sup><i class="fa fa-asterisk"></i></sup></label>
                                <div class="col-sm-8">
                                    {{ Form::text('phone_1', $contact['phone_1'] ,array('class' => 'form-control input-sm hide-form', 'placeholder' => '.e.g. 0701234567', 'disabled' => 'disabled')) }}
                                </div>
                                <div class="col-md-2 ">
                                    <button type="submit" class="btn btn-warning pull-right form-edit">Edit</button>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Phone 2</label>
                                <div class="col-md-8">
                                    {{ Form::text('phone_2', $contact['phone_2'],array('class' => 'form-control input-sm hide-form', 'placeholder' => '.e.g. 0701234567', 'disabled' => 'disabled')) }}
                                </div><!-- /.input group -->
                            </div><!-- /.form group -->

                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Mobile 1 </label>
                                <div class="col-sm-8">
                                    {{ Form::text('mobile_1', $contact['mobile_1'] ,array('class' => 'form-control input-sm hide-form', 'placeholder' => '.e.g. 042 123 456', 'disabled' => 'disabled')) }}
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Mobile 2 </label>
                                <div class="col-sm-8">
                                    {{ Form::text('mobile_2', $contact['mobile_2'] ,array('class' => 'form-control input-sm hide-form', 'placeholder' => '.e.g. 042 123 456', 'disabled' => 'disabled')) }}
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-2 control-label">School Info Email <sup><i class="fa fa-asterisk"></i></sup></label>
                                <div class="col-sm-8">
                                    {{Form::email('info_email', $contact['info_email'], array('placeholder' => '.e.g. schoolname@yahoo.com', 'class' => 'form-control input-sm hide-form', 'disabled' => 'disabled'))}}
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-2 control-label">School Academic Email</label>
                                <div class="col-sm-8">
                                    {{Form::email('academic_email', $contact['academic_email'], array('placeholder' => '.e.g. schoolname@yahoo.com', 'class' => 'form-control input-sm hide-form' , 'disabled' => 'disabled'))}}
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-2 control-label">School Sales Email</label>
                                <div class="col-sm-8">
                                    {{Form::email('sale_email', $contact['sale_email'] , array('placeholder' => '.e.g. schoolname@yahoo.com', 'class' => 'form-control input-sm hide-form', 'disabled' => 'disabled'))}}
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-2 control-label">Website</label>
                                <div class="col-sm-8">
                                    {{Form::text('website', $contact['website'], array('placeholder' => '.e.g. www.school.com', 'class' => 'form-control input-sm hide-form', 'disabled' => 'disabled'))}}
                                    <input type="hidden" value="{{ $school->id }}" name="id">
                                </div>
                            </div>

                            {{--<div class="form-group">--}}
                                {{--<label for="inputPassword3" class="col-sm-2 control-label">Facebook Page</label>--}}
                                {{--<div class="col-sm-8">--}}
                                    {{--{{Form::text('facebook_page', '', array('placeholder' => '.e.g.', 'class' => 'form-control input-sm'))}}--}}
                                {{--</div>--}}
                            {{--</div>--}}

                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Fax</label>
                                <div class="col-sm-8">
                                    {{ Form::text('fax', $contact['fax'] ,array('class' => 'form-control input-sm hide-form', 'disabled' => 'disabled')) }}
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Telex</label>
                                <div class="col-sm-8">
                                    {{ Form::text('telex', $contact['telex'] ,array('class' => 'form-control input-sm hide-form', 'disabled' => 'disabled')) }}
                                </div>
                            </div>

                            <div class="box-footer">
                                <button type="submit" class="btn btn-info" style="display: none;">Save</button>
                            </div><!-- /.box-footer -->
                            <div class="box-footer">
                                The fields with the <span style="color: red">asterisks</span> are <span style="color: red">compulsory</span>. <br>
                                Please provide <span style="color: #005983">good and accurate Information</span>, for a better search.
                            </div>
                        {{ Form::close() }}
                    </div>
                </div><!-- /.box -->
            </div>
        </div>
    </section>
    {{ HTML::script('js/school-admin/school-contact-structure.js'); }}
@stop