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
        <div class="row tv-extra">
            <div class="col-md-12">
                <div class="box box-default location">
                    <div class="box-header with-border">
                        <h3 class="box-title"></h3>
                        <div class="box-tools pull-right">
                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                            <div class="btn-group">
                                <button class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown"><i class="fa fa-wrench"></i></button>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="#" id="add-new-data">Add your own data</a></li>
                                    <li class="divider"></li>
                                    <li><a href="#">Separated link</a></li>
                                </ul>
                            </div>
                            <button class="btn btn-box-tool refresh"><i class="fa fa-refresh"></i></button>
                            <img src="/css/ajax-loader.gif" class="pull-right img-loader giphy">
                        </div>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        {{ Form::open(array('class' => 'tvbasic form-horizontal', 'route' => 'post_tv_school_extras')) }}
                            <div class="form-group">
                                <label  class="col-sm-2 control-label">Average Student in Boarding Room </label>
                                <div class="col-sm-6 col-md-6">
                                    <select   name="average-student" id="average-student">
                                        <option value="{{ $tertiary['average_student'] }}" selected="selected">{{  $tertiary['average_student'] }}</option>
                                    </select>
                                    <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                                    <input type="hidden" value="{{ $school->id }}" name="id" id="id">
                                </div>
                            </div>
                            <div class="form-group">
                                <label  class="col-sm-2 control-label">Admission age limit </label>
                                <div class="col-sm-6 col-md-6">
                                    <select  name="age_limit" id="age_limit">
                                        <option value="{{ $tertiary['admission_age_limit'] }}" selected="selected">{{  $tertiary['admission_age_limit'] }}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label  class="col-sm-2 control-label">Medical Facilities</label>
                                <div class="col-sm-6 col-md-6">
                                    <select class="form-control select2"  name="medical_facilities[]" id="medical" multiple="true">
                                        @if(!empty(unserialize($tertiary['medical_facility'])))
                                            @foreach(unserialize($tertiary['medical_facility']) as $t)
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
                                        @if(!empty(unserialize($tertiary['health_prof'])))
                                            @foreach(unserialize($tertiary['health_prof']) as $t)
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
                                        @if(!empty(unserialize($tertiary['sport_facility'])))
                                            @foreach(unserialize($tertiary['sport_facility']) as $t)
                                                <option value="{{ $t }}" selected="selected">{{ $t }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label  class="col-sm-2 control-label">Clubs & Society</label>
                                <div class="col-sm-6 col-md-6">
                                    <select class="form-control select2"  name="club[]" id="clubs" multiple="true">
                                        @if(!empty(unserialize($tertiary['club_society'])))
                                            @foreach(unserialize($tertiary['club_society']) as $t)
                                                <option value="{{ $t }}" selected="selected">{{ $t }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label  class="col-sm-2 control-label">Accommodation Facility</label>
                                <div class="col-sm-6 col-md-6">
                                    <select class="form-control select2"  name="accommodation[]" id="accommodation" multiple="true">
                                        @if(!empty(unserialize($tertiary['accommodation'])))
                                            @foreach(unserialize($tertiary['accommodation']) as $t)
                                                <option value="{{ $t }}" selected="selected">{{ $t }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>

                        @if($school->school_type == "vocation")
                            <div class="form-group">
                                <label  class="col-sm-2 control-label">Program Offered</label>
                                <div class="col-sm-6 col-md-6">
                                    <select class="form-control select2"  name="program[]" id="program" multiple="true">
                                        @if(!empty(unserialize($tertiary['program_offered'])))
                                            @foreach(unserialize($tertiary['program_offered']) as $t)
                                                <option value="{{ $t }}" selected="selected">{{ $t }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label  class="col-sm-2 control-label">Category of Vocation</label>
                                <div class="col-sm-6 col-md-6">
                                    <select class="form-control select2"  name="vocation_category[]" id="vocation" multiple="true">
                                        @if(!empty(unserialize($tertiary['vocation_category'])))
                                            @foreach(unserialize($tertiary['vocation_category']) as $t)
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
                                        @if(!empty(unserialize($tertiary['vocational_facility'])))
                                            @foreach(unserialize($tertiary['vocational_facility']) as $t)
                                                <option value="{{ $t }}" selected="selected">{{ $t }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                        @endif
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
