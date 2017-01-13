@extends('layouts.admin-dashboard-layout')
@section('content')
        <!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
       Search User
    </h1>
    <ol class="breadcrumb">
        <li><a href="/admin/home"><i class="fa fa-dashboard"></i>Home</a></li>
        <li><a href="#">Search</a></li>
    </ol>
</section>

<section class="content">
    <div class="col-md-12">
        <div class="box box-default location" >
            <div class="box-header with-border">
                <h3 class="box-title">Search for user by email</h3>
                <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                </div>
            </div><!-- /.box-header -->
            <div class="box-body" style="padding-bottom: 30px; padding-top: 30px;">
                <div class="col-md-4 col-md-offset-4">
                    {{Form::open(array('class' => 'search-by-email form-horizontal', 'route' => 'user_by_email'))}}
                        <div class="input-group input-group-lg">
                            <input type="text" class="form-control" placeholder="Enter User's Email" name="email">
                                <span class="input-group-btn">
                                      <button class="btn btn-info btn-flat" type="submit">LookUp!</button>
                                </span>
                        </div><!-- /input-group -->
                    {{ Form::close() }}

                </div>
                <div class="col-md-2 col-md-offset-1 ajax-loader">
                    <div class="loader-inner ball-pulse-sync">
                        <div></div>
                        <div></div>
                        <div></div>
                    </div>
                </div>
            </div>
        </div><!-- /.box -->
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">User Found ?</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Date Joined</th>
                            <th>Number of Schools</th>
                            <th>Status</th>
                            <th colspan="3" style="text-align: center">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            <td><a class="user_name" href="#" data-user-id=""></a> </td>
                            <td class="user-email"></td>
                            <td class="user-date"></td>
                            <td class="user-sch"></td>
                            <td class="user-status"></td>
                            <td><a href="#" class="approved" data-id=""><i data-id="" class="fa fa-thumbs-up" style="color: grey; font-size: 18px;"></i></a></td>
                            <td><a href="#" class="suspend" data-id=""><i data-id="" class="fa fa-ban" style="color: #ffae1a; font-size: 18px;"></i></a></td>
                        </tbody>
                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div>
</section>

{{ HTML::script('js/site-admin/user_section.js'); }}
@stop