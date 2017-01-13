@extends('layouts.school-dashboard-layout')
@section('content')
    <section class="content-header">
        <h1>
            School Data
        </h1>
        <ol class="breadcrumb">
            <li><a href="/school/home"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">School Affiliation</li>
        </ol>
    </section>

    <section class="content">
        <!-- Logo Upload -->
        <div class="row">
            <div class="col-md-12">
                <div class="box box-default location">
                    <div class="box-header with-border">
                        <h3 class="box-title">School Affiliation</h3>
                        <div class="box-tools pull-right">
                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        {{ Form::open(array('class' => 'affiliation form-horizontal', 'route' => 'post_school_affiliation')) }}
                        <div class="form-group">
                            <label  class="col-md-2 control-label">Affiliation 1</label>
                            <div class="col-md-6">
                                {{ Form::text('affiliations_1', $affiliation['affiliations_1'] ,array('placeholder' => 'Affiliation 1', 'class' => 'form-control hide-form', 'id' => '', 'disabled'=>'disabled')) }}
                                <input type="hidden" value="{{ $school->id }}" name="id">
                            </div>

                            <div class="col-md-3">
                                <button type="submit" class="btn btn-warning pull-right form-edit">Edit</button>
                            </div>
                        </div>

                        <div class="form-group">
                            <label  class="col-md-2 control-label">Affiliation 2</label>
                            <div class="col-md-6">
                                {{ Form::text('affiliations_2', $affiliation['affiliations_2'],array('placeholder' => 'Affiliation 2', 'class' => 'form-control hide-form', 'id' => '', 'disabled'=>'disabled')) }}
                            </div>
                        </div>

                        <div class="form-group">
                            <label  class="col-md-2 control-label">Affiliation 3</label>
                            <div class="col-md-6">
                                {{ Form::text('affiliations_3', $affiliation['affiliations_3'] ,array('placeholder' => 'Affiliation 3', 'class' => 'form-control hide-form', 'id' => '', 'disabled'=>'disabled')) }}
                            </div>
                        </div>

                        <div class="form-group">
                            <label  class="col-md-2 control-label">Affiliation 4</label>
                            <div class="col-md-6">
                                {{ Form::text('affiliations_4', $affiliation['affiliations_4'] ,array('placeholder' => 'Affiliation 4', 'class' => 'form-control hide-form', 'id' => '', 'disabled'=>'disabled')) }}
                            </div>
                        </div>

                        <div class="form-group">
                            <label  class="col-md-2 control-label">Affiliation 5</label>
                            <div class="col-md-6">
                                {{ Form::text('affiliations_5', $affiliation['affiliations_5'],array('placeholder' => 'Affiliation 5', 'class' => 'form-control hide-form', 'id' => '', 'disabled'=>'disabled')) }}
                            </div>
                        </div>

                        <div class="form-group">
                            <label  class="col-md-2 control-label">Affiliation 6</label>
                            <div class="col-md-6">
                                {{ Form::text('affiliations_6', $affiliation['affiliations_6'],array('placeholder' => 'Affiliation 6', 'class' => 'form-control hide-form', 'id' => '', 'disabled'=>'disabled')) }}
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
