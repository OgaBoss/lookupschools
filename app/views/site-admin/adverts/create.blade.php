@extends('layouts.admin-dashboard-layout')
@section('content')
    <section class="content-header">
        <h1>
            Adverts
        </h1>
        <ol class="breadcrumb">
            <li><a href="/admin/home"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Adverts</li>
        </ol>
    </section>

    <section class="content">
        <!-- Logo Upload -->
        <div class="row">
            <div class="col-md-12">
                <div class="box box-default location">
                    <div class="box-header with-border">
                        <h3 class="box-title">Create Adverts</h3>
                        <div class="box-tools pull-right">
                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        {{ Form::open(array('class' => 'adverts form-horizontal', 'route' => 'create_advert')) }}
                            <div class="form-group">
                                <label  class="col-md-2 control-label">Advert Name</label>
                                <div class="col-md-6">
                                    {{ Form::text('name', '' ,array('placeholder' => 'Advert Name', 'class' => 'form-control hide-form', 'id' => '')) }}
                                </div>
                            </div>

                            <div class="form-group">
                                <label  class="col-md-2 control-label">Description</label>
                                <div class="col-md-6">
                                    {{ Form::textarea('description', '' ,array('placeholder' => 'Advert Name', 'class' => 'form-control hide-form', 'rows' => '4', 'cols'=>'50')) }}
                                </div>
                            </div>

                            <div class="form-group">
                                <label  class="col-md-2 control-label">Price</label>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-addon">#</span>
                                        <input type="text" class="form-control" name="price">
                                        <span class="input-group-addon">.00</span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label  class="col-md-2 control-label">Type</label>
                                <div class="col-md-6">
                                    <select name="type" id="">
                                        <option value="image">Image</option>
                                        <option value="video">Video</option>
                                        <option value="modal">Modal</option>
                                    </select>
                                </div>
                            </div>

                            <div class="box-footer">
                                <button type="submit" class="btn btn-info pull-right">Save</button>
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
                        <h3 class="box-title">All Adverts</h3>
                        <div class="box-tools pull-right">
                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <div class="col-xs-12 table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Price</th>
                                    <th>Duration</th>
                                    <th>Type</th>
                                    <th>Status</th>
                                    <th colspan="2">Action</th>

                                </tr>
                                </thead>
                                @foreach($ads as $ad)
                                    <tbody>
                                        <td>{{ ucfirst($ad->name) }}</td>
                                        <td>{{ ucfirst($ad->description) }}</td>
                                        <td>{{ $ad->price }}</td>
                                        <td>{{ ucfirst($ad->validity) }}</td>
                                        <td>{{ ucfirst($ad->type) }}</td>
                                        @if($ad->status)
                                            <td><small class="label bg-green status_ar_{{$ad->id}}">Approved</small></td>
                                        @else
                                            <td><small class="label bg-red status_su_{{$ad->id}}">Suspended</small></td>
                                        @endif
                                        @if($ad->status)
                                            <td><a href="#" class="approved" data-id="{{$ad->id}}"><i data-id="{{$ad->id}}" class="fa fa-thumbs-up" style="color: grey; font-size: 18px;"></i></a></td>
                                        @else
                                            <td><a href="#" class="approve" data-id="{{$ad->id}}"><i data-id="{{$ad->id}}" class="fa fa-thumbs-up" style="color: #009a00; font-size: 18px;"></i></a></td>
                                        @endif
                                        @if($ad->status)
                                            <td><a href="#" class="suspend" data-id="{{$ad->id}}"><i data-id="{{$ad->id}}" class="fa fa-ban" style="color: #ffae1a; font-size: 18px;"></i></a></td>
                                        @else
                                            <td><a href="#" class="suspended" data-id="{{$ad->id}}"><i data-id="{{$ad->id}}" class="fa fa-ban" style="color: grey; font-size: 18px;"></i></a></td>
                                        @endif
                                    </tbody>
                                @endforeach

                            </table>
                        </div><!-- /.col -->
                    </div>
                </div><!-- /.box -->
            </div>
        </div>
    </section>
    {{ HTML::script('js/site-admin/bill_ads.js'); }}

@stop