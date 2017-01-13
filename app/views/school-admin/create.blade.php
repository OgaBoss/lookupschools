@extends('layouts.school-dashboard-layout')
@section('content')
    <section class="content-header">
        <h1>
            School's Administrators
        </h1>
        <ol class="breadcrumb">
            <li><a href="/school/home"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">School Admin</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-default location">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-pencil"></i> Create Users</h3>
                        <div class="box-tools pull-right">
                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <!-- general form elements -->
                        <!-- form start -->
                        {{Form::open(array('class' => 'create_user form-horizontal', 'route' => 'createNewUser'))}}
                            <div class="form-group">
                                <label  class="col-md-2 control-label">First Name <sup><i class="fa fa-asterisk"></i></sup></label>
                                <div class="col-md-4">
                                    {{ Form::text('firstname', '',array('placeholder' => 'New user\'s first name', 'class' => 'form-control', 'id' => 'first-name')) }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label  class="col-md-2 control-label">Last Name <sup><i class="fa fa-asterisk"></i></sup></label>
                                <div class="col-md-4">
                                    {{ Form::text('lastname', '',array('placeholder' => 'New user\'s last name', 'class' => 'form-control', 'id' => 'last-name')) }}
                                </div>
                            </div>

                            <div class="form-group">
                                <label  class="col-md-2 control-label">Email <sup><i class="fa fa-asterisk"></i></sup></label>
                                <div class="col-md-4">
                                    {{ Form::text('email', '',array('placeholder' => 'New user\'s email', 'class' => 'form-control', 'id' => 'email', 'type' => 'email')) }}
                                </div>
                            </div>

                            <div class="form-group">
                                <label  class="col-md-2 control-label">Type <sup><i class="fa fa-asterisk"></i></sup></label>
                                <div class="col-md-4">
                                    <select name="type" class="form-control">
                                        <option value=""></option>
                                        <option value="user">Admin</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label  class="col-md-2 control-label">Attach to <sup><i class="fa fa-asterisk"></i></sup></label>
                                <div class="col-md-4">
                                    <select name="attach[]" class="form-control select2" multiple="true">
                                        <option value=""></option>
                                        @foreach($schools as $sh)
                                            <option value="{{$sh->id}}}">{{$sh->name}}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>

                            <div class="box-footer">
                                <button type="submit" class="btn btn-info">Create User</button>
                            </div><!-- /.box-footer -->
                        {{Form::close()}}
                        <div class="box-footer">
                            The fields with the <span style="color: red">asterisks</span> are <span style="color: red">compulsory</span>. <br>
                        </div>
                        <br>
                        <br>

                        <div class="box-footer">
                            <h4><i class="fa fa-pencil"></i> Edit Users</h4>
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="box">
                                        <div class="box-header">
                                            <h3 class="box-title">Users attached to {{$school['name']}}</h3>
                                            <div class="box-tools">
                                            </div>
                                        </div><!-- /.box-header -->
                                        <div class="box-body table-responsive no-padding">
                                            <table class="table table-hover">
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Status</th>
                                                    <th colspan="3" style="text-align: center">Action</th>
                                                </tr>
                                                @forelse($schoolUsers as $user)
                                                    <tr>
                                                        <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                                                        <td>{{ $user->email }}</td>
                                                        <td><small class="label bg-green">Approved</small></td>
                                                        <td><a href="#"><i class="fa fa-trash" style="color: #ff0000; font-size: 18px;"></i></a></td>
                                                        <td><a href="#"><i class="fa fa-thumbs-up" style="color: #009a00; font-size: 18px;"></i></a></td>
                                                        <td><a href="#"><i class="fa fa-ban" style="color: #ffae1a; font-size: 18px;"></i></a></td>
                                                    </tr>
                                                @empty
                                                @endforelse

                                            </table>
                                        </div><!-- /.box-body -->
                                    </div><!-- /.box -->
                                </div>
                            </div>
                        </div>
                    </div><!-- /.box-body -->

                    <div class="box-footer">
                        The fields with the <span style="color: red">asterisks</span> are <span style="color: red">compulsory</span>. <br>
                        Please provide <span style="color: #005983">good and accurate Information</span>, for a better search.
                    </div>
                </div><!-- /.box -->
            </div>
        </div>
    </section>
    {{ HTML::script('js/school-admin/create-user.js'); }}

@stop