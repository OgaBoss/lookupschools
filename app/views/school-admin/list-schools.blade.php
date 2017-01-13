@extends('layouts.school-list-layout')
@section('content')

    <section class="content-header">
        <h1>
            Dashboard Home
        </h1>
        <ol class="breadcrumb">
            <li><a href="/school/home"><i class="fa fa-dashboard"></i> Home</a></li>
        </ol>
    </section>
    <section class="content">
        <div class="box box-danger">
            <div class="box-header">
                @if(count($schools) > 1)
                    <h3 class="box-title">Your Schools</h3>
                @else
                    <h3 class="box-title">Your School</h3>
                @endif

            </div><!-- /.box-header -->
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    @if(count($schools) > 0)
                        @foreach(array_chunk($schools->all(),3) as $row)
                            <div class="row">
                                @foreach($row as $school)
                                    <div class="col-md-4">
                                        <div class="panel panel-primary" style="border-radius: 0;">
                                            <!-- Default panel contents -->
                                            <div class="panel-heading" style="border-radius: 0;">{{ $school->name }}</div>
                                            <div class="panel-body school-list">
                                                <a href="/school/{{ $school->slug }}/basic_information">
                                                    <article class="caption">
                                                        @if(count($school->photos) > 0)
                                                            @foreach($school->photos as $img)
                                                                <img class="caption__media" src="{{ $img['openURL'] }}" />
                                                            @endforeach
                                                        @else
                                                            <img class="caption__media" src="/img/school-icon.png" />
                                                        @endif
                                                        <div class="caption__overlay">
                                                            <h1 class="caption__overlay__title">{{ $school->name }}</h1>
                                                            <p class="caption__overlay__content">{{ $school->structure['school_head'] }}</p>
                                                        </div>
                                                    </article>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    @else
                        <p>No school yet, please click <a href="/school/show_school">here</a></p>
                    @endif

                </div>
                <div class="col-md-3"></div>
            </div>

            <div class="box-footer">
                Please click on each school for more details
            </div>
        </div><!-- /.box -->
    </section>

@stop