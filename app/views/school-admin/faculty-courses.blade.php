@extends('layouts.school-dashboard-layout')
@section('content')
    <section class="content-header">
        <h1>
            Faculty and Courses
        </h1>
        <ol class="breadcrumb">
            <li><a href="/school/home"><i class="fa fa-dashboard"></i> Home</a></li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
                    <div class="box-header">
                        <h4>Please select the faculties available in your school</h4>
                    </div><!-- /.box-header -->
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6 faculty-body">
                            {{ Form::open( array('class' => 'faculty-course form-horizontal', 'route' => 'post_faculty_courses') ) }}
                            <div class="row">
                                <div class="col-xs-5">
                                    <select name="from[]" id="multiselect" class="form-control" size="8" multiple="multiple">
                                        @foreach($faculty as $fac)
                                            <option value={{ $fac['id'] }}>{{ ucfirst($fac['name']) }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-xs-2" style="margin-top: 70px;">
                                    {{--<button type="button" id="multiselect_rightAll" class="btn btn-block"><i class="fa fa-forward"></i></button>--}}
                                    <button type="button" id="multiselect_rightSelected" class="btn btn-block"><i class="fa fa-chevron-right"></i></button>
                                    <button type="button" id="multiselect_leftSelected" class="btn btn-block"><i class="fa fa-chevron-left"></i></button>
                                    {{--<button type="button" id="multiselect_leftAll" class="btn btn-block"><i class="fa fa-backward"></i></button>--}}
                                </div>

                                <div class="col-xs-5">
                                    <select name="to[]" id="multiselect_to" class="form-control" size="8" multiple="multiple">
                                        @foreach($schoolFaculty as $fac)
                                            <option value={{ $fac['id'] }}>{{ ucfirst($fac['name']) }}</option>
                                        @endforeach
                                    </select>
                                    <br>
                                    <button type="submit" class="btn btn-info">Update</button>
                                </div>
                            </div>
                            <input type="hidden" value="{{ $school->id }}" name="id" id="id">
                            {{ Form::close() }}
                        </div>
                        <div class="col-md-3"></div>
                    </div>
                </div><!-- /.box -->
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="box box-default location">
                    <div class="box-header with-border">
                        <h3 class="box-title">Please select courses for each faculty</h3>
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
                        <?php $count = 0; $course = [];?>
                        @forelse($schoolFaculty as $fac)
                            <div class="row">
                                <?php $count++; ?>
                                {{ Form::open(array('class' => 'tvbasic form-horizontal', 'route' => 'post_tv_school_extras')) }}
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label  class="col-sm-2 control-label">{{ ucfirst($fac['name']) }}</label>
                                        <div class="col-sm-6 col-md-6">
                                            <select class="form-control select2" data-faculty-id="{{$fac['id'] }}" name="{{$fac['name'] }}[]" id="{{$fac['name'] }}" multiple="true" data-select-id="select-for-{{ $count }}">
                                                @forelse($fac->courses as $fc)
                                                    @foreach(unserialize($fc['course']) as $t)
                                                        <?php $course[] = $t ?>
                                                        <option value="{{ $t }}" selected="selected"> {{ ucfirst($t) }}</option>
                                                    @endforeach
                                                @empty
                                                    <option value=""></option>
                                                @endforelse
                                                @foreach($fac->course as $f)
                                                    @if(!in_array($f['name'], $course))
                                                       <option value="{{ $f['name'] }}"> {{ ucfirst($f['name']) }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="">
                                        <button type="submit" class="btn btn-info save-course" data-button-id="select-for-{{ $count }}">Save</button>
                                    </div><!-- /.box-footer -->
                                </div>
                                {{ Form::close() }}
                            </div>
                        @empty
                        @endforelse

                    </div>
                </div>
            </div>
        </div>
    </section>
    {{ HTML::script('js/school-admin/faculty.js'); }}
@stop