@extends('layouts.admin-dashboard-layout')
@section('content')
        <!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Users Tables
    </h1>
    <ol class="breadcrumb">
        <li><a href="/admin/home"><i class="fa fa-dashboard"></i>Home</a></li>
        <li><a href="#">Users</a></li>
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
                            <th>Name</th>
                            <th>Date Joined</th>
                            <th>Number of Schools</th>
                            <th>Status</th>
                            <th colspan="3" style="text-align: center">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            @if($user->hasAccess('admin'))
                                <tr>
                                    <td>{{ $user->first_name." ".$user->last_name }}</td>
                                    <td>{{ date("F jS, Y",strtotime($user->created_at)) }}</td>
                                    <td>{{ count($user->schools) }}</td>
                                    @if($user->activated == 1)
                                        <td><small class="label bg-green">Approved</small></td>
                                    @else
                                        <td><small class="label bg-red">Supended</small></td>
                                    @endif
                                    {{--<td><a href="#" class="ban" data-id="{{$user->id}}"><i data-id="{{$user->id}}" class="fa fa-trash" style="color: #ff0000 !important; font-size: 18px;"></i></a></td>--}}
                                    @if($user->isActivated())
                                        <td><a href="#" class="approved" data-id="{{$user->id}}"><i data-id="{{$user->id}}" class="fa fa-thumbs-up" style="color: grey; font-size: 18px;"></i></a></td>
                                    @else
                                        <td><a href="#" class="approve" data-id="{{$user->id}}"><i data-id="{{$user->id}}" class="fa fa-thumbs-up" style="color: #009a00; font-size: 18px;"></i></a></td>
                                    @endif
                                    @if($user->isActivated())
                                        <td><a href="#" class="suspend" data-id="{{$user->id}}"><i data-id="{{$user->id}}" class="fa fa-ban" style="color: #ffae1a; font-size: 18px;"></i></a></td>
                                    @else
                                        <td><a href="#" class="suspended" data-id="{{$user->id}}"><i data-id="{{$user->id}}" class="fa fa-ban" style="color: grey; font-size: 18px;"></i></a></td>
                                    @endif
                                </tr>
                            @endif

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
                            <li><a href="http://{{$_SERVER['HTTP_HOST']}}/admin/users?page={{ $i }}">{{ $i }}</a></li>
                        @endfor
                    @endif
                </ul>
            </nav>
        </div>
    </div>
</section><!-- /.content -->
{{ HTML::script('js/site-admin/user_section.js'); }}
@stop