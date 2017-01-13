@extends('layouts.school-dashboard-layout')
@section('content')
    <section class="content-header">
        <h1>
            School Data
        </h1>
        <ol class="breadcrumb">
            <li><a href="/school/home"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">School Structure</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-default location">
                    <div class="box-header with-border">
                        <h3 class="box-title">School Structure</h3>
                        <div class="box-tools pull-right">
                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        {{ Form::open(array('class' => 'structure form-horizontal', 'route' => 'post_school_structure')) }}
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Yr Founded <sup><i class="fa fa-asterisk"></i></sup></label>
                                <div class="col-sm-6">
                                    <div class="input-group">
                                        <div class="input-group-addon hide-form">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        {{ Form::text('dob', $structure['dob'],array('class' => 'form-control input-sm hide-form', 'id' => 'datemask', 'data-inputmask' => "'alias': 'dd/mm/yyyy'",'data-mask', 'disabled' => 'disabled')) }}
                                        <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />

                                    </div>
                                </div><!-- /.input group -->
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-warning pull-right form-edit">Edit</button>
                                </div>
                            </div><!-- /.form group -->

                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-2 control-label">School Head</label>
                                <div class="col-md-6">
                                    {{ Form::text('school_head', $structure['school_head'],array('placeholder' => '.e.g. Mrs Alibiosu','disabled' => 'disabled', 'class' => 'form-control input-sm hide-form', 'id' => 'school-head')) }}
                                    <input type="hidden" value="{{ $school->id }}" name="id">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label">Sex Orientation</label>
                                <div class="col-md-6 ">
                                    <select class="form-control select2 hide-form"  name="sex" id="sex" disabled>
                                        <option value="{{ $structure['sex'] }}" selected="selected">{{ $structure['sex'] }}</option>
                                        <option value="Boys-Only">Boys-Only</option>
                                        <option value="Girls-Only">Girls-Only</option>
                                        <option value="Co-Education" >Co-Education</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group ownership">
                                <label class="col-md-2 control-label">Ownership</label>
                                <div class="col-md-6 ">
                                    <select class="form-control select2 hide-form"  name="ownership" id="ownership" disabled>
                                        <option value="{{ $structure['ownership'] }}" selected="selected">{{ $structure['ownership'] }}</option>
                                        <option value="Public">Public</option>
                                        <option value="Private" >Private</option>
                                    </select>
                                </div>
                            </div>

                            <!-- IF PUBLIC -->
                            <div class="form-group public">
                                <label class="col-md-2 control-label">Public Ownership</label>
                                <div class="col-md-6 ">
                                    <select class="form-control select2 hide-form"  name="public" id="public" disabled>
                                        <option value="{{ $structure['public'] }}" selected="selected">{{ $structure['public'] }}</option>
                                        <option value="Military">Military</option>
                                        <option value="Federal">Federal</option>
                                        <option value="State" >State</option>
                                        <option value="Local-Government" >Local-Government</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group military">
                                <label class="col-md-2 control-label">Military</label>
                                <div class="col-md-6 ">
                                    <select class="form-control select2 hide-form"  name="military" id="military" disabled>
                                        <option value="{{ $structure['public'] }}" selected="selected">{{ $structure['public'] }}</option>
                                        <option value="Full Military Program">Full Military Program</option>
                                        <option value="Extra Curricular Military Program">Extra Curricular Military Program</option>
                                        <option value="No Military Program" >No Military Program</option>
                                    </select>
                                </div>
                            </div>

                            <!-- IF PRIVATE -->
                            <div class="form-group private">
                                <label class="col-md-2 control-label">Private Ownership</label>
                                <div class="col-md-6 ">
                                    <select class="form-control select2 hide-form"  name="private" id="private" disabled>
                                        <option value="{{ $structure['private'] }}" selected="selected">{{ $structure['private'] }}</option>
                                        <option value="Business">Business</option>
                                        <option value="NGO">NGO</option>
                                        <option value="Religious" >Religious</option>
                                        <option value="Community" >Community</option>
                                    </select>
                                </div>
                            </div>

                            <!-- IF RELIGION -->
                            <div class="form-group">
                                <label class="col-md-2 control-label">Religion</label>
                                <div class="col-md-6 ">
                                    <select class="form-control select2 hide-form"  name="religion" id="religion" disabled>
                                        <option value="{{ $structure['religion'] }}" selected="selected">{{ $structure['religion'] }}</option>
                                        <option value="Christian">Christian</option>
                                        <option value="Muslim">Muslim</option>
                                        <option value="Not Religion Based">Not Religion Based</option>
                                        <option value="Others" >Others</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label">School Type</label>
                                <div class="col-md-6 ">
                                    <select class="form-control select2 hide-form"  name="school_type" id="school_type" disabled>
                                        <option value="{{ $structure['school_type'] }}" selected="selected">{{ $structure['school_type'] }}</option>
                                        <option value="Day">Day</option>
                                        <option value="Boarding">Boarding</option>
                                        <option value="Both" >Both</option>
                                    </select>
                                </div>
                            </div>

                            <!-- IF TERTIARY -->
                            @if($school->school_type == 'tertiary')
                            <div class="form-group">
                                <label class="col-md-2 control-label">Tertiary</label>
                                <div class="col-md-6 ">
                                    <select class="form-control select2 hide-form"  name="tertiary" id="tertiary" disabled>
                                        <option value="{{ $structure['tertiary'] }}" selected="selected">{{ $structure['tertiary'] }}</option>
                                        <option value="University">University</option>
                                        <option value="Polytechnic">Polytechnic</option>
                                        <option value="Monotechnic" >Monotechnic</option>
                                        <option value="College-Of-Education" >College-Of-Education</option>
                                    </select>
                                </div>
                            </div>
                            @endif

                            @if($school->school_type == 'preschool')
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Preschool</label>
                                    <div class="col-md-6 ">
                                        <select class="form-control select2 hide-form"  name="preschool" id="tertiary" disabled>
                                            <option value="{{ $structure['tertiary'] }}" selected="selected">{{ $structure['tertiary'] }}</option>
                                            <option value="creche">Creche</option>
                                            <option value="play-group">Play-Group</option>
                                        </select>
                                    </div>
                                </div>
                            @endif

                            <div class="form-group">
                                <label class="col-md-2 control-label">School Fee Range</label>
                                <div class="col-md-10 ">
                                    <input id="range_2" type="text" name="range_2" value="0;10000000" data-disable="true" data-type="double" data-step="10000" data-postfix=" Niara" data-from="{{ $structure['min'] ? $structure['min'] : 100000 }}" data-to="{{ $structure['max'] ? $structure['max'] : 1000000 }}" data-hasgrid="true" />
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