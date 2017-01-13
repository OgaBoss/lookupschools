@extends('layouts.school-dashboard-layout')
@section('content')
    <link rel="stylesheet" href="/css/form-edit.css">
    <section class="content-header">
        <h1>
            SignUp for Adverts
        </h1>
        <ol class="breadcrumb">
            <li><a href="/school/home"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Adverts</li>
        </ol>
    </section>

    <section class="content">
        <!-- Logo Upload -->

        @forelse($adverts as $advert)
            @if($advert->status == 1)
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div class="box box-primary location collapsed-box">
                            <div class="box-header with-border">
                                <h3 class="box-title">{{ $advert->name }}</h3>
                                <div class="box-tools pull-right">
                                    <i class="fa fa-spin fa-spinner loader-{{ $advert->type }}" style="font-size: 24px; color: green; display:none;"></i>
                                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                                </div>
                            </div><!-- /.box-header -->
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="">Description : <span>{{ $advert->description }} </span></label></br>
                                        <label for="">Price : <span>#{{ $advert->price}}</span></label></br>
                                        <label for="">Duration : <span>{{ $advert->validity }}days</span></label><br/>
                                    </div>
                                </div>
                            </div>

                            @if(in_array($advert->id, $data))
                                {{ Form::open(array('class' => 'ad_cancel', 'route' => 'cancel_ad')) }}
                                <div class="box-footer">
                                    <button type="submit" class="btn btn-danger pull-right">Cancel</button>
                                    <input type="hidden" value="{{$school->id}}" name="id">
                                    <input type="hidden" value="{{$advert->id}}" name="aid">
                                </div><!-- /.box-footer -->
                                {{ Form::close() }}
                            @else
                                {{ Form::open(array('class' => 'ad_sign', 'route' => 'ad_signup')) }}
                                @if($advert->type == 'video')
                                    <div class="box-footer">
                                        <div class="form-group">
                                            <label  class="col-md-2 control-label">Video Url <sup><i class="fa fa-question-circle ads" title=""></i> </sup></label>
                                            <div class="col-md-10">
                                                {{ Form::text('video_url', '',array('placeholder' => 'https://www.youtube.com/watch?v=sAUWB263-bY', 'class' => 'form-control', 'id' => 'school-name')) }}
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                @if($advert->type == 'modal')
                                    <div class="box-footer">
                                        <div class="form-group">
                                            <label  class="col-md-2 control-label">Video Url</label>
                                            <select name="" id="modal_type">
                                                <option value="image">Make use of school Image</option>
                                                <option value="video">Make use of video</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="box-footer modal_url" style="display: none;">
                                        <div class="form-group">
                                            <label  class="col-md-2 control-label">Video Url <sup><i class="fa fa-question-circle ads" title=""></i> </sup></label>
                                            <div class="col-md-10">
                                                {{ Form::text('video_url', '',array('placeholder' => 'https://www.youtube.com/watch?v=sAUWB263-bY', 'class' => 'form-control', 'id' => 'school-name')) }}
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <div class="box-footer">
                                    <div class="col-xs-6">
                                        {{ HTML::image('/img/visa.png', 'User Image', array('class' => '')) }}
                                        {{ HTML::image('/img/mastercard.png', 'User Image', array('class' => '')) }}
                                    </div><!-- /.col -->
                                    Quantity: <select name="qty" id="">
                                        <option value="monthly">Monthly</option>
                                        <option value="yearly">Yearly</option>
                                    </select>
                                    <button type="submit" class="btn btn-info btn-save pull-right">SignUp</button>
                                    <input type="hidden" value="{{$school->id}}" name="id">
                                    <input type="hidden" value="{{$advert->id}}" name="aid">
                                    <input type="hidden" value="{{$advert->name}}" name="name">
                                    <input type="hidden" value="{{$advert->type}}" name="type">
                                    <input type="hidden" value="{{$advert->price}}" name="price">
                                </div><!-- /.box-footer -->
                                {{ Form::close() }}
                            @endif
                        </div>
                    </div><!-- /.box -->
                </div>
            @else
            @endif
        @empty
            <p>No adverts at this moment</p>
        @endforelse

        {{--@foreach($data as $ad)--}}
            {{--<div class="row">--}}
                {{--<div class="col-md-3"></div>--}}
                {{--<div class="col-md-6">--}}
                    {{--<div class="box box-default location">--}}
                        {{--<div class="box-header with-border">--}}
                            {{--<h3 class="box-title">{{ $ad->name }}</h3>--}}
                            {{--<div class="box-tools pull-right">--}}
                                {{--<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>--}}
                            {{--</div>--}}
                        {{--</div><!-- /.box-header -->--}}
                        {{--<div class="box-body">--}}
                            {{--<label for="">Duration : <span>{{ $ad->duration }} days</span></label></br>--}}
                            {{--<label for="">Days left : <span>{{ (strtotime($ad->expiry_date) - strtotime(date('Y-m-d')))/86400 }}  days</span></label></br>--}}
                            {{--<label for="">Price : {{ $ad->payment }} <span>Naira</span></label></br>--}}
                        {{--</div><!-- /.box-body -->--}}
                        {{--{{ Form::open(array('class' => 'ad_sign', 'route' => 'ad_signup')) }}--}}
                        {{--<div class="box-footer">--}}
                            {{--<button type="submit" class="btn btn-danger btn-save pull-right">Cancel</button>--}}
                            {{--<input type="hidden" value="{{$ad->school_id}}" name="id">--}}
                            {{--<input type="hidden" value="{{$ad->advert_id}}" name="aid">--}}
                        {{--</div>--}}
                        {{--{{ Form::close() }}--}}
                    {{--</div><!-- /.box -->--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--@endforeach--}}
    </section>
@stop