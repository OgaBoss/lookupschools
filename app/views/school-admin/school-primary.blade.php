@extends('layouts.school-dashboard-layout')
@section('content')
    <section class="content-header">
        <h1>
            School Data
        </h1>
        <ol class="breadcrumb">
            <li><a href="/school/home"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Extra Information</li>
        </ol>
    </section>
    <section class="content">
        <div class="row primary-extra">
            <div class="col-md-12">
                <div class="box box-default location">
                    <div class="box-header with-border">
                        <h3 class="box-title">Section 1</h3>
                        <div class="box-tools pull-right">
                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        {{ Form::open(array('class' => 'primary-section-one form-horizontal', 'route' => 'post_pps_school_extras_one')) }}
                            <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                            <input type="hidden" value="{{ $school->id }}" name="id" id="id">
                            @if($school->school_type == "preschool")
                                <div class="form-group">
                                <label  class="col-sm-2 control-label">Average No. of kids in a room </label>
                                <div class="col-sm-6 col-md-6">
                                    <select  name="average-baby-no" id="average-child-no">
                                        <option value="{{ $primary['average_children_daycare'] }}" selected="selected">{{  $primary['average_children_daycare'] }}</option>
                                    </select>
                                </div>
                            </div>

                                <div class="form-group">
                                    <label  class="col-sm-2 control-label">Daycare locker-type</label>
                                    <div class="col-sm-6 col-md-6">
                                        {{ Form::select('daycare_locker_type', array('Individual' => 'Individual', 'Communal' => 'Communal'), $primary['daycare_locker_type'], ['class' => 'select2 form-control input-sm sch-typ']) }}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Nanny Baby Ratio</label>
                                    <div class="col-sm-6">
                                        1 : <select id="nanny_baby_ratio" name="nanny_baby_ratio">
                                            <option value="{{ $primary['nanny_baby_ratio'] }}" selected="selected">{{  $primary['nanny_baby_ratio'] }}</option>
                                        </select>
                                    </div><!-- /.input group -->
                                </div><!-- /.form group -->
                            @endif

                            @if($school->school_type == "secondary" || $school->school_type == "primary")
                                <div class="form-group">
                                    <label  class="col-sm-2 control-label">Average Student in a class </label>
                                    <div class="col-sm-6 col-md-6">
                                        <select   name="average-class-no" id="average-class-no">
                                            <option value="{{ $primary['average_children_class'] }}" selected="selected">{{  $primary['average_children_class'] }}</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label  class="col-sm-2 control-label">Average Student in Boarding Room </label>
                                    <div class="col-sm-6 col-md-6">
                                        <select   name="average-child-room" id="average-child-room">
                                            <option value="{{ $primary['average_child_room'] }}" selected="selected">{{  $primary['average_child_room'] }}</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label  class="col-sm-2 control-label">Boarding locker-type</label>
                                    <div class="col-sm-6 col-md-6">
                                        {{ Form::select('boarding_locker_type', array('Individual' => 'Individual', 'Communal' => 'Communal'), $primary['boarding_locker_type'], ['class' => 'select2 form-control input-sm sch-typ']) }}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Teacher Student Ratio</label>
                                    <div class="col-sm-6">
                                        1 : <select id="teacher_student_ratio" name="teacher_student_ratio">
                                            <option value="{{ $primary['teacher_student_ratio'] }}" selected="selected">{{  $primary['teacher_student_ratio'] }}</option>
                                        </select>
                                    </div><!-- /.input group -->
                                </div><!-- /.form group -->
                            @endif

                            <div class="form-group">
                                <label  class="col-sm-2 control-label">Admission age limit </label>
                                <div class="col-sm-6 col-md-6">
                                    <select  name="age_limit" id="age_limit_pps">
                                        <option value="{{ $primary['admission_age_limit'] }}" selected="selected">{{  $primary['admission_age_limit'] }}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label  class="col-sm-2 control-label">ICT Room</label>
                                <div class="col-sm-6 col-md-6">
                                    {{ Form::select('ict_room', array('Yes' => 'Yes', 'No' => 'No'), $primary['ict_room'], ['class' => 'select2 form-control input-sm sch-typ']) }}
                                </div>
                            </div>

                            <div class="box-footer">
                                <button type="submit" class="btn btn-info">Save</button>
                            </div><!-- /.box-footer -->
                        {{ Form::close() }}
                    </div>
                </div><!-- /.box -->
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="box box-default location">
                    <div class="box-header with-border">
                        <h3 class="box-title">Section 2</h3>
                        <div class="box-tools pull-right">
                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                            <div class="btn-group">
                                <button class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown"><i class="fa fa-wrench"></i></button>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="#" id="add-new-data"><i class="fa fa-plus"></i> Add your own data</a></li>
                                </ul>
                            </div>
                            <button class="btn btn-box-tool refresh"><i class="fa fa-refresh"></i></button>
                            <img src="/css/ajax-loader.gif" class="pull-right img-loader giphy">
                        </div>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        {{ Form::open(array('class' => 'primary-section-two form-horizontal', 'route' => 'post_pps_school_extras_two')) }}
                            <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                            <input type="hidden" value="{{ $school->id }}" name="id" id="id">
                            <div class="form-group">
                                <label  class="col-sm-2 control-label">Medical Facilities</label>
                                <div class="col-sm-6 col-md-6">
                                    <select class="form-control select2"  name="medical_facility[]" id="medical" multiple="true">
                                        @if(!empty(unserialize($primary['medical_facility'])))
                                            @foreach(unserialize($primary['medical_facility']) as $t)
                                                <option value="{{ $t }}" selected="selected">{{ $t }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label  class="col-sm-2 control-label">Daycare Facilities</label>
                                <div class="col-sm-6 col-md-6">
                                    <select class="form-control select2"  name="daycare_facility[]" id="daycare" multiple="true">
                                        @if(!empty(unserialize($primary['daycare_facility'])))
                                            @foreach(unserialize($primary['daycare_facility']) as $t)
                                                <option value="{{ $t }}" selected="selected">{{ $t }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label  class="col-sm-2 control-label">Health Professional</label>
                                <div class="col-sm-6 col-md-6">
                                    <select class="form-control select2"  name="health_prof[]" id="health" multiple="true">
                                        @if(!empty(unserialize($primary['health_prof'])))
                                            @foreach(unserialize($primary['health_prof']) as $t)
                                                <option value="{{ $t }}" selected="selected">{{ $t }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label  class="col-sm-2 control-label">Vocational Facilities</label>
                                <div class="col-sm-6 col-md-6">
                                    <select class="form-control select2"  name="vocational_facility[]" id="vocational" multiple="true">
                                        @if(!empty(unserialize($primary['vocational_facility'])))
                                            @foreach(unserialize($primary['vocational_facility']) as $t)
                                                <option value="{{ $t }}" selected="selected">{{ $t }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label  class="col-sm-2 control-label">Sport Facilities</label>
                                <div class="col-sm-6 col-md-6">
                                    <select class="form-control select2"  name="sport_facility[]" id="sport" multiple="true">
                                        @if(!empty(unserialize($primary['sport_facility'])))
                                            @foreach(unserialize($primary['sport_facility']) as $t)
                                                <option value="{{ $t }}" selected="selected">{{ $t }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label  class="col-sm-2 control-label">Subject Offered</label>
                                <div class="col-sm-6 col-md-6">
                                    <select class="form-control select2"  name="subject_offered[]" id="subject" multiple="true">
                                        @if(!empty(unserialize($primary['subject_offered'])))
                                            @foreach(unserialize($primary['subject_offered']) as $t)
                                                <option value="{{ $t }}" selected="selected">{{ $t }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label  class="col-sm-2 control-label">Clubs and Societies</label>
                                <div class="col-sm-6 col-md-6">
                                    <select class="form-control select2"  name="clubs_societies[]" id="clubs" multiple="true">
                                        @if(!empty(unserialize($primary['clubs_societies'])))
                                            @foreach(unserialize($primary['clubs_societies']) as $t)
                                                <option value="{{ $t }}" selected="selected">{{ $t }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="box-footer">
                                <button type="submit" class="btn btn-info">Save</button>
                            </div><!-- /.box-footer -->
                        {{ Form::close() }}
                    </div>
                </div><!-- /.box -->
            </div>
        </div>
    </section>
    {{ HTML::script('js/school-admin/school-primary-tertiary.js'); }}
@stop