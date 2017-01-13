@extends('layouts.admin-dashboard-layout')
@section('content')
    <section class="content-header">
        <h1>
            Admin DashBoard
        </h1>
        <ol class="breadcrumb">
            <li><a href="/admin/home"><i class="fa fa-dashboard"></i> Home</a></li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-danger">
                    <div class="box-header">
                        <h3 class="box-title">DashBoard Options</h3>
                    </div><!-- /.box-header -->
                    <div class="row">
                        <div class="box-body">
                            <div class="col-md-2"></div>
                            <div class="col-md-8">
                                <div class="row" id="ad-icons">
                                    <div class="col-md-4 col-xs-4 col-lg-4">
                                        <a href="/admin/users"><i class="fa fa-users fa-4x"></i></a>
                                        <span class="ad-title">Users</span>
                                    </div>
                                    <div class="col-md-4 col-xs-4 col-lg-4 ">
                                        <a href="#"><i class="fa fa-graduation-cap fa-4x"></i></a>
                                        <span class="ad-title">Schools</span>
                                    </div>
                                    <div class="col-md-4 col-xs-4 col-lg-4 ">
                                        <a href="#"><i class="fa fa-credit-card fa-4x"></i></a>
                                        <span class="ad-title">Billing</span>
                                    </div>
                                </div>

                                <div class="row" id="ad-icons">
                                    <div class="col-md-4 col-xs-4 col-lg-4">
                                        <a href="/admin/advert"><i class="fa fa-cart-plus fa-4x"></i></a>
                                        <span class="ad-title">Adverts</span>
                                    </div>
                                    <div class="col-md-4 col-xs-4 col-lg-4 ">
                                        <a href="/admin/site_data"><i class="fa fa-database fa-4x"></i></a>
                                        <span class="ad-title">Data</span>
                                    </div>
                                    <div class="col-md-4 col-xs-4 col-lg-4 ">
                                        <a href="#"><i class="fa fa-pencil-square-o fa-4x"></i></a>
                                        <span class="ad-title">Content </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2"></div>
                        </div>
                    </div>
                    <div class="box-footer">
                        Please click on each icon for more details
                    </div>
                </div><!-- /.box -->
            </div>
        </div>

    </section>
@stop