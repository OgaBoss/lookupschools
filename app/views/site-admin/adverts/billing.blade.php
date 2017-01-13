@extends('layouts.admin-dashboard-layout')
@section('content')
    <section class="content-header">
        <h1>
            Billings
        </h1>
        <ol class="breadcrumb">
            <li><a href="/admin/home"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Billings</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-default location">
                    <div class="box-header with-border">
                        <h3 class="box-title">Current Adverts</h3>
                        <div class="box-tools pull-right">
                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <div class="col-xs-12 table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>School Name</th>
                                    <th>Advert Name</th>
                                    <th>Payments</th>
                                    <th>Duration</th>
                                    <th>Expiry Date</th>
                                    <th colspan="2">Action</th>

                                </tr>
                                </thead>
                                @foreach($bills as $bill)
                                    <tbody>
                                        <td>{{ $bill->id }}</td>
                                        <td>{{ $bill->school_slug }}</td>
                                        <td>{{ $bill->advert_name }}</td>
                                        <td>#{{ $bill->payments }}</td>
                                        <td>{{ $bill->duration }} days</td>
                                        <td>{{ $bill->date_end }}</td>
                                    </tbody>
                                @endforeach

                            </table>
                        </div><!-- /.col -->
                    </div>
                </div><!-- /.box -->
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="box box-default location">
                    <div class="box-header with-border">
                        <h3 class="box-title">Canceled Adverts</h3>
                        <div class="box-tools pull-right">
                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <div class="col-xs-12 table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>School Name</th>
                                    <th>Advert Name</th>
                                    <th>Payments</th>
                                    <th>Duration</th>
                                    <th>Expiry Date</th>
                                    <th colspan="2">Action</th>

                                </tr>
                                </thead>
                                @foreach($dels as $bill)
                                    <tbody>
                                    <td>{{ $bill->id }}</td>
                                    <td>{{ $bill->school_slug }}</td>
                                    <td>{{ $bill->advert_name }}</td>
                                    <td>#{{ $bill->payments }}</td>
                                    <td>{{ $bill->duration }} days</td>
                                    <td>{{ $bill->date_end }}</td>
                                    </tbody>
                                @endforeach

                            </table>
                        </div><!-- /.col -->
                    </div>
                </div><!-- /.box -->
            </div>
        </div>
    </section>
@stop