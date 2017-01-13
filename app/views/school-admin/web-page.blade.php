@extends('layouts.school-dashboard-layout')
@section('content')

    <!-- Start Post Attachments -->
    <div class="modal fade" id="uploader" tabindex="-1" role="dialog" aria-labelledby="updater" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <i class="fa fa-spin fa-spinner" style="font-size: 17px; display: none;"></i>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">✕</button>
                    <br>
                    <i class="icon-credit-card icon-7x"></i>
                    <p class="no-margin">You can upload only 1 JPEG file at a time!</p>
                </div>
                <div class="modal-body">
                    <form action="" class="uploadform dropzone no-margin dz-clickable" data-id="">
                        <div class="dz-default dz-message">
                            <span>Drop your Cover Picture here</span>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default attachtopost" data-dismiss="modal">Close</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
    <!-- End Post Attachments -->


    <section class="content-header">
        <h1>
            School Website
            <small>Data to build up school website</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">WebSite Data</li>
        </ol>
    </section>
    <section class="content">
        <!-- Logo Upload -->
        <div class="row">
            <div class="col-md-12">
                <div class="box box-default location">
                    <div class="box-header with-border">
                        <h3 class="box-title">School Statements</h3>
                        <div class="box-tools pull-right">
                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-10">
                                {{ Form::open(array('class' => 'statement form-horizontal', 'route' => 'statement')) }}
                                    <div class="form-group">
                                        <label  class="col-md-2 control-label">School Moto</label>
                                        <div class="col-md-6">
                                            {{ Form::text('moto', $school['moto'] ,array('placeholder' => 'e.g. In God we trust.', 'class' => 'form-control hide-form', 'id' => '', 'disabled'=>'disabled')) }}
                                            <input type="hidden" value="{{ $school->id }}" name="id">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label  class="col-md-2 control-label">School Vision Stament</label>
                                        <div class="col-md-6">
                                            {{ Form::text('vision', $school['vision'] ,array('placeholder' => 'e.g. In God we trust.', 'class' => 'form-control hide-form', 'id' => '', 'disabled'=>'disabled')) }}
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label  class="col-md-2 control-label">School Mission Statement</label>
                                        <div class="col-md-6">
                                            {{ Form::text('mission', $school['mission'] ,array('placeholder' => 'e.g. In God we trust.', 'class' => 'form-control hide-form', 'id' => '', 'disabled'=>'disabled')) }}
                                        </div>
                                    </div>

                                    <div class="box-footer">
                                        <button type="submit" class="btn btn-info" style="display: none;">Save</button>
                                    </div><!-- /.box-footer -->
                                    <div class="box-footer">
                                        Please provide <span style="color: #005983">good and accurate Information</span>, for a better search.
                                    </div>
                                {{ Form::close() }}
                            </div>
                            <div class="col-md-2">
                                    <button type="submit" class="btn btn-warning pull-right form-edit">Edit</button>
                            </div>
                        </div>

                    </div>
                </div><!-- /.box -->
            </div>
        </div>
    </section>

    <section class="content">
        <!-- Logo Upload -->
        <div class="row">
            <div class="col-md-12">
                <div class="box box-default location">
                    <div class="box-header with-border">
                        <h3 class="box-title">School Team</h3>
                        <div class="box-tools pull-right">
                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="box box-info location">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">Team Member 1</h3>
                                        <div class="box-tools pull-right">
                                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                            <div class="img-loader">
                                                <img src="/css/ajax-loader.gif" class="pull-right">
                                            </div>
                                        </div>
                                    </div><!-- /.box-header -->
                                    <div class="box-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <form id="uploadimage" enctype="multipart/form-data">
                                                    <div class="form-group">
                                                        <label for="exampleInputFile">File input</label>
                                                        <input type="file" id="image_upload" name="file" accept="image/*" data-url="/mini-site/school/upload" data-type="team" data-image-class="team-member-1" data-form="team-form-1" data-team-count="team-member-1" />
                                                        <input type="hidden" value="{{ $school->id }}" name="id" id="id">
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="row">
                                            {{ HTML::image( isset($team_1['image_url']) ? $team_1['image_url'] : '/img/user.png', 'User Image', array('class' => 'img-circle user_profile_pic team-member team-member-1', 'width'=>'70', 'height'=>'70')) }}
                                        </div>

                                        <div class="row team-member team-form-1" style="display: none; margin-top: 15px">
                                            <div class="col-md-12">
                                                <div class="col-md-10">
                                                    {{ Form::open(array('class' => 'member_one form-horizontal', 'route' => 'team-member')) }}
                                                    <div class="form-group">
                                                        <label  class="col-md-2 control-label">Name</label>
                                                        <div class="col-md-10">
                                                            {{ Form::text('name', $team_1['name'] ,array('placeholder' => 'e.g. Mr John Snow.', 'class' => 'form-control hide-form', 'id' => '', 'disabled'=>'disabled')) }}
                                                            <input type="hidden" value="{{ $school->id }}" name="id">
                                                            <input type="hidden" value="team-member-1" name="team_count">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label  class="col-md-2 control-label">Position</label>
                                                        <div class="col-md-10">
                                                            {{ Form::text('position', $team_1['position'] ,array('placeholder' => 'VP Acedemics or Prinicpal or HOD Arts', 'class' => 'form-control hide-form', 'id' => '', 'disabled'=>'disabled')) }}
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label  class="col-md-2 control-label">Bio</label>
                                                        <div class="col-md-10">
                                                            {{ Form::textarea('bio', $team_1['bio'] ,array('placeholder' => 'e.g. ...has certficate from Havard University...', 'class' => 'form-control hide-form bio', 'id' => '', 'disabled'=>'disabled', 'rows'=>'4')) }}
                                                        </div>
                                                    </div>

                                                    <div class="box-footer">
                                                        <button type="submit" class="btn btn-info" style="display: none;">Save</button>
                                                    </div><!-- /.box-footer -->
                                                    {{ Form::close() }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- /.box -->
                            </div>
                            <div class="col-md-4">
                                <div class="box box-info location">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">Team Member 2</h3>
                                        <div class="box-tools pull-right">
                                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                            <div class="img-loader-2">
                                                <img src="/css/ajax-loader.gif" class="pull-right">
                                            </div>
                                        </div>
                                    </div><!-- /.box-header -->
                                    <div class="box-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <form id="uploadimage" enctype="multipart/form-data">
                                                    <div class="form-group">
                                                        <label for="exampleInputFile">File input</label>
                                                        <input type="file" id="image_upload_2" name="file" accept="image/*" data-url="/mini-site/school/upload" data-type="team" data-image-class="team-member-2" data-form="team-form-2" data-team-count="team-member-2" />
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="row">
                                            {{ HTML::image( isset($team_2['image_url']) ? $team_2['image_url'] : '/img/user.png', 'User Image', array('class' => 'img-circle user_profile_pic team-member team-member-2', 'width'=>'70', 'height'=>'70')) }}
                                        </div>
                                        <div class="row team-member team-form-2" style="display: block; margin-top: 15px">
                                            <div class="col-md-12">
                                                <div class="col-md-10">
                                                    {{ Form::open(array('class' => 'member_one form-horizontal', 'route' => 'team-member')) }}
                                                    <div class="form-group">
                                                        <label  class="col-md-2 control-label">Name</label>
                                                        <div class="col-md-10">
                                                            {{ Form::text('name', $team_2['name'] ,array('placeholder' => 'e.g. Mr John Snow.', 'class' => 'form-control hide-form', 'id' => '', 'disabled'=>'disabled')) }}
                                                            <input type="hidden" value="{{ $school->id }}" name="id">
                                                            <input type="hidden" value="team-member-2" name="team_count">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label  class="col-md-2 control-label">Position</label>
                                                        <div class="col-md-10">
                                                            {{ Form::text('position', $team_2['position'] ,array('placeholder' => 'VP Acedemics or Prinicpal or HOD Arts', 'class' => 'form-control hide-form', 'id' => '', 'disabled'=>'disabled')) }}
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label  class="col-md-2 control-label">Bio</label>
                                                        <div class="col-md-10">
                                                            {{ Form::textarea('bio', $team_2['bio'] ,array('placeholder' => 'e.g. ...has certficate from Havard University...', 'class' => 'form-control hide-form bio', 'id' => '', 'disabled'=>'disabled', 'rows'=>'4')) }}
                                                        </div>
                                                    </div>

                                                    <div class="box-footer">
                                                        <button type="submit" class="btn btn-info" style="display: none;">Save</button>
                                                    </div><!-- /.box-footer -->
                                                    {{ Form::close() }}
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div><!-- /.box -->
                            </div>
                            <div class="col-md-4">
                                <div class="box box-info location">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">Team Member 3</h3>
                                        <div class="box-tools pull-right">
                                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                            <div class="img-loader-3">
                                                <img src="/css/ajax-loader.gif" class="pull-right">
                                            </div>
                                        </div>
                                    </div><!-- /.box-header -->
                                    <div class="box-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <form id="uploadimage" enctype="multipart/form-data">
                                                    <div class="form-group">
                                                        <label for="exampleInputFile">File input</label>
                                                        <input type="file" id="image_upload_3" name="file" accept="image/*" data-url="/mini-site/school/upload" data-type="team" data-image-class="team-member-3" data-form="team-form-3" data-team-count="team-member-3" />
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="row">
                                            {{ HTML::image( isset($team_3['image_url']) ? $team_3['image_url'] : '/img/user.png', 'User Image', array('class' => 'img-circle user_profile_pic team-member team-member-3', 'width'=>'70', 'height'=>'70')) }}
                                        </div>
                                        <div class="row team-member team-form-3" style="display: block; margin-top: 15px">
                                            <div class="col-md-12">
                                                <div class="col-md-10">
                                                    {{ Form::open(array('class' => 'member_one form-horizontal', 'route' => 'team-member')) }}
                                                    <div class="form-group">
                                                        <label  class="col-md-2 control-label">Name</label>
                                                        <div class="col-md-10">
                                                            {{ Form::text('name', $team_3['name'] ,array('placeholder' => 'e.g. Mr John Snow.', 'class' => 'form-control hide-form', 'id' => '', 'disabled'=>'disabled')) }}
                                                            <input type="hidden" value="{{ $school->id }}" name="id">
                                                            <input type="hidden" value="team-member-3" name="team_count">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label  class="col-md-2 control-label">Position</label>
                                                        <div class="col-md-10">
                                                            {{ Form::text('position', $team_3['position'] ,array('placeholder' => 'VP Acedemics or Prinicpal or HOD Arts', 'class' => 'form-control hide-form', 'id' => '', 'disabled'=>'disabled')) }}
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label  class="col-md-2 control-label">Bio</label>
                                                        <div class="col-md-10">
                                                            {{ Form::textarea('bio', $team_3['bio'] ,array('placeholder' => 'e.g. ...has certficate from Havard University...', 'class' => 'form-control hide-form bio', 'id' => '', 'disabled'=>'disabled', 'rows'=>'4')) }}
                                                        </div>
                                                    </div>

                                                    <div class="box-footer">
                                                        <button type="submit" class="btn btn-info" style="display: none;">Save</button>
                                                    </div><!-- /.box-footer -->
                                                    {{ Form::close() }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- /.box -->
                            </div>
                        </div>
                    </div>
                </div><!-- /.box -->
            </div>
        </div>
    </section>
    <section class="content">
        <!-- Logo Upload -->
        <div class="row">
            <div class="col-md-12">
                <div class="box box-default location">
                    <div class="box-header with-border">
                        <h3 class="box-title">Testimonies</h3>
                        <div class="box-tools pull-right">
                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="box box-success location">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">Testimony 1</h3>
                                        <div class="box-tools pull-right">
                                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                            <div class="testimony-loader-1">
                                                <img src="/css/ajax-loader.gif" class="pull-right">
                                            </div>
                                        </div>
                                    </div><!-- /.box-header -->
                                    <div class="box-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <form id="uploadimage" enctype="multipart/form-data">
                                                    <div class="form-group">
                                                        <label for="exampleInputFile">File input</label>
                                                        <input type="file" id="testimony_upload_1" name="file" accept="image/*" data-url="/mini-site/school/testimony" data-type="testimony" data-image-class="testimony-1" data-form="testimony-form-1" data-team-count="testimony-1" />
                                                        <input type="hidden" value="{{ $school->id }}" name="id" id="id">
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="row">
                                            {{ HTML::image( isset($testimony_1['image_url']) ? $testimony_1['image_url'] : '/img/user.png', 'User Image', array('class' => 'img-circle user_profile_pic team-member testimony-1', 'width'=>'70', 'height'=>'70')) }}
                                        </div>

                                        <div class="row team-member testimony-form-1" style="display: block; margin-top: 15px">
                                            <div class="col-md-12">
                                                <div class="col-md-10">
                                                    {{ Form::open(array('class' => 'testimony_one form-horizontal', 'route' => 'setTestimony')) }}
                                                    <div class="form-group">
                                                        <label  class=" control-label">Name</label>
                                                        {{ Form::text('name', $testimony_1['name'] ,array('placeholder' => 'e.g. Mr John Snow.', 'class' => 'form-control hide-form', 'id' => '', 'disabled'=>'disabled')) }}
                                                        <input type="hidden" value="{{ $school->id }}" name="id">
                                                        <input type="hidden" value="testimony-1" name="count">
                                                    </div>
                                                    <div class="form-group">
                                                        <label  class="control-label">Testimony</label>
                                                        {{ Form::textarea('testimony', $testimony_1['testimony'] ,array('placeholder' => 'e.g. ...This is the best school in the world...', 'class' => 'form-control hide-form bio', 'id' => '', 'disabled'=>'disabled', 'rows'=>'4')) }}
                                                    </div>
                                                    <div class="box-footer">
                                                        <button type="submit" class="btn btn-info" style="display: none;">Save</button>
                                                    </div><!-- /.box-footer -->
                                                    {{ Form::close() }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- /.box -->
                            </div>
                            <div class="col-md-4">
                                <div class="box box-success location">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">Testimony 2</h3>
                                        <div class="box-tools pull-right">
                                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                            <div class="testimony-loader-2">
                                                <img src="/css/ajax-loader.gif" class="pull-right">
                                            </div>
                                        </div>
                                    </div><!-- /.box-header -->
                                    <div class="box-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <form id="uploadimage" enctype="multipart/form-data">
                                                    <div class="form-group">
                                                        <label for="exampleInputFile">File input</label>
                                                        <input type="file" id="testimony_upload_2" name="file" accept="image/*" data-url="/mini-site/school/testimony" data-type="testimony" data-image-class="testimony-2" data-form="testimony-form-2" data-team-count="testimony-2" />
                                                        <input type="hidden" value="{{ $school->id }}" name="id" id="id">
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="row">
                                            {{ HTML::image( isset($testimony_2['image_url']) ? $testimony_2['image_url'] : '/img/user.png', 'User Image', array('class' => 'img-circle user_profile_pic team-member testimony-2', 'width'=>'70', 'height'=>'70')) }}
                                        </div>

                                        <div class="row team-member testimony-form-2" style="display: block; margin-top: 15px">
                                            <div class="col-md-12">
                                                <div class="col-md-10">
                                                    {{ Form::open(array('class' => 'testimony_one form-horizontal', 'route' => 'setTestimony')) }}
                                                    <div class="form-group">
                                                        <label  class="control-label">Name</label>
                                                        {{ Form::text('name', $testimony_2['name'] ,array('placeholder' => 'e.g. Mr John Snow.', 'class' => 'form-control hide-form', 'id' => '', 'disabled'=>'disabled')) }}
                                                        <input type="hidden" value="{{ $school->id }}" name="id">
                                                        <input type="hidden" value="testimony-2" name="count">
                                                    </div>
                                                    <div class="form-group">
                                                        <label  class="control-label">Testimony</label>
                                                        {{ Form::textarea('testimony', $testimony_2['testimony'] ,array('placeholder' => 'e.g. ...This is the best school in the world...', 'class' => 'form-control hide-form bio', 'id' => '', 'disabled'=>'disabled', 'rows'=>'4')) }}
                                                    </div>
                                                    <div class="box-footer">
                                                        <button type="submit" class="btn btn-info" style="display: none;">Save</button>
                                                    </div><!-- /.box-footer -->
                                                    {{ Form::close() }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- /.box -->
                            </div>
                            <div class="col-md-4">
                                <div class="box box-success location">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">Testimony 3</h3>
                                        <div class="box-tools pull-right">
                                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                            <div class="testimony-loader-3">
                                                <img src="/css/ajax-loader.gif" class="pull-right">
                                            </div>
                                        </div>
                                    </div><!-- /.box-header -->
                                    <div class="box-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <form id="uploadimage" enctype="multipart/form-data">
                                                    <div class="form-group">
                                                        <label for="exampleInputFile">File input</label>
                                                        <input type="file" id="testimony_upload_3" name="file" accept="image/*" data-url="/mini-site/school/testimony" data-type="testimony" data-image-class="testimony-3" data-form="testimony-form-3" data-team-count="testimony-3" />
                                                        <input type="hidden" value="{{ $school->id }}" name="id" id="id">
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="row">
                                            {{ HTML::image( isset($testimony_3['image_url']) ? $testimony_3['image_url'] : '/img/user.png', 'User Image', array('class' => 'img-circle user_profile_pic team-member testimony-3', 'width'=>'70', 'height'=>'70')) }}
                                        </div>

                                        <div class="row team-member testimony-form-3" style="display: block; margin-top: 15px">
                                            <div class="col-md-12">
                                                <div class="col-md-10">
                                                    {{ Form::open(array('class' => 'testimony_one form-horizontal', 'route' => 'setTestimony')) }}
                                                    <div class="form-group">
                                                        <label  class="control-label">Name</label>
                                                        {{ Form::text('name', $testimony_3['name'] ,array('placeholder' => 'e.g. Mr John Snow.', 'class' => 'form-control hide-form', 'id' => '', 'disabled'=>'disabled')) }}
                                                        <input type="hidden" value="{{ $school->id }}" name="id">
                                                        <input type="hidden" value="testimony-3" name="count">
                                                    </div>
                                                    <div class="form-group">
                                                        <label  class="control-label">Testimony</label>
                                                        {{ Form::textarea('testimony', $testimony_3['testimony'] ,array('placeholder' => 'e.g. ...This is the best school in the world...', 'class' => 'form-control hide-form bio', 'id' => '', 'disabled'=>'disabled', 'rows'=>'4')) }}
                                                    </div>
                                                    <div class="box-footer">
                                                        <button type="submit" class="btn btn-info" style="display: none;">Save</button>
                                                    </div><!-- /.box-footer -->
                                                    {{ Form::close() }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- /.box -->
                            </div>
                        </div>
                    </div>
                </div><!-- /.box -->
            </div>
        </div>
    </section>

    {{ HTML::script('js/school-admin/web-site.js'); }}

@stop
