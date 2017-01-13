@extends('layouts.admin-dashboard-layout')
@section('content')
    <section class="content-header">
        <h1>
            Sport Data
        </h1>
        <ol class="breadcrumb">
            <li><a href="/admin/home"><i class="fa fa-dashboard"></i>Home</a></li>
            <li><a href="#">Sport Data</a></li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">School Admin</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>S.No</th>
                                <th>Name</th>
                                <th colspan="2" style="text-align: center;">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $d)
                                <tr>
                                    <td>{{ $count++ }}</td>
                                    <td>{{ $d->name }}</td>
                                    <td style="text-align: center;"><a href="#" class="delete" data-id="{{$d->id}}" data-type="sport"><i data-id="{{$d->id}}" class="fa fa-trash" style="color: #ff0000 !important; font-size: 18px; text-align: center;"></i></a></td>
                                    <td style="text-align: center;"><a href="#" class="edit" data-id="{{$d->id}}" data-type="sport"><i data-id="{{$d->id}}" class="fa fa-pencil-square" style="color: #000; font-size: 18px; text-align: center;"></i></a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->
        <div class="row">
            <div class="col-md-6 col-md-offset-6">
                <nav class="pull-right">
                    <ul class="pagination">
                        @if($page_number > 1)
                            @for($i=1;$i<=$page_number;$i++)
                                <li class="{{ $page == $i ? 'active' : '' }}"><a href="http://{{$_SERVER['HTTP_HOST']}}/admin/data_get/sport?page={{ $i }}">{{ $i }}</a></li>
                            @endfor
                        @endif
                    </ul>
                </nav>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-6">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">New Sport Data</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        {{ Form::open(array('class' => 'data form-horizontal', 'route' => 'data_post')) }}
                            <div class="form-group textbox1">
                                <label  class="col-md-2 control-label">Name</label>
                                <div class="col-md-8 ">

                                    <input type="hidden" name="data-type" value="sport">
                                </div>
                                <div class="col-md-2 pull-left">
                                    <a href="#">
                                        <i class="fa fa-plus-circle" aria-hidden="true" style="font-size: 22px; color:#00c0ef;"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="box-footer">
                                <button type="submit" class="btn btn-info">Save</button>
                            </div><!-- /.box-footer -->
                        {{ Form::close() }}
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </section>
    {{ HTML::script('js/site-admin/data_section.js'); }}
@stop