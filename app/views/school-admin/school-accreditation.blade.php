@extends('layouts.school-dashboard-layout')
@section('content')
    <section class="content-header">
        <h1>
            School Data
        </h1>
        <ol class="breadcrumb">
            <li><a href="/school/home"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">School Accreditation</li>
        </ol>
    </section>

    <section class="content">
        <!-- Logo Upload -->
        <div class="row">
            <div class="col-md-12">
                <div class="box box-default location">
                    <div class="box-header with-border">
                        <h3 class="box-title">School Accreditation</h3>
                        <div class="box-tools pull-right">
                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                       {{ Form::open(array('class' => 'accreditation form-horizontal', 'route' => 'post_school_accreditation')) }}
                            <div class="form-group">
                                <label  class="col-md-2 control-label">Accreditation 1</label>
                                <div class="col-md-6">
                                    <input type="hidden" value="{{ $school->id }}" name="id">
                                    {{ Form::text('accreditation_1', $accreditation['accreditations_1'],array('placeholder' => 'Accreditation 1', 'class' => 'form-control hide-form', 'id' => '', 'disabled'=>'disabled')) }}
                                </div>
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-warning pull-right form-edit">Edit</button>
                                </div>
                            </div>

                            <div class="form-group">
                                <label  class="col-md-2 control-label">Accreditation 2</label>
                                <div class="col-md-6">
                                    {{ Form::text('accreditation_2',$accreditation['accreditations_2'],array('placeholder' => 'Accreditation 2', 'class' => 'form-control hide-form', 'id' => '', 'disabled'=>'disabled')) }}
                                </div>
                            </div>

                            <div class="form-group">
                                <label  class="col-md-2 control-label">Accreditation 3</label>
                                <div class="col-md-6">
                                    {{ Form::text('accreditation_3', $accreditation['accreditations_3'],array('placeholder' => 'Accreditation 3', 'class' => 'form-control', 'id' => '', 'disabled'=>'disabled')) }}
                                </div>
                            </div>

                            <div class="form-group">
                                <label  class="col-md-2 control-label">Accreditation 4</label>
                                <div class="col-md-6">
                                    {{ Form::text('accreditation_4',$accreditation['accreditations_4'],array('placeholder' => 'Accreditation 4', 'class' => 'form-control hide-form', 'id' => '', 'disabled'=>'disabled')) }}
                                </div>
                            </div>

                            <div class="form-group">
                                <label  class="col-md-2 control-label">Accreditation 5</label>
                                <div class="col-md-6">
                                    {{ Form::text('accreditation_5',$accreditation['accreditations_5'],array('placeholder' => 'Accreditation 5', 'class' => 'form-control hide-form', 'id' => '', 'disabled'=>'disabled')) }}
                                </div>
                            </div>
                            <div class="box-footer">
                                <button type="submit" class="btn btn-info">Save</button>
                            </div><!-- /.box-footer -->
                        <div class="box-footer">
                            Please provide <span style="color: #005983">good and accurate Information</span>, for a better search.
                        </div>
                       {{ Form::close() }}
                    </div>
                </div><!-- /.box -->
            </div>
        </div>
    </section>
    {{ HTML::script('js/school-admin/school-affiliation-accreditation.js'); }}
@stop