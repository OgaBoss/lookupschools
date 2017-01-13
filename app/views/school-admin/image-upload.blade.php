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
           Upload Image
        </h1>
        <ol class="breadcrumb">
            <li><a href="/school/home"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Image Upload</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-default location">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-pencil"></i>Upload Image for Web Page</h3>
                        <div class="box-tools pull-right">
                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-8 col-md-offset-2 load">
                                <a data-toggle="modal" data-target="#uploader" style="cursor:pointer" class="icon"><img class="uicon" src="/img/cloud.png" data-id="{{$school->id}}"></a
                            </div>
                        </div>
                    </div>
                </div><!-- /.box -->
            </div>
        </div>
    </section>

    <section class="content">
        <div class="row light-image">
            <div class="col-md-12">
                <div class="box box-default location">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-pencil"></i>Uploaded Images</h3>
                        <div class="box-tools pull-right">
                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="demo-gallery">
                                <ul id="lightgallery" class="list-unstyled row">
                                    @forelse($images as $img)
                                        <li class="col-md-2" data-src="{{ $img->openURL }}" >
                                            <a href="">
                                                <img class="img-responsive" src="{{ $img->openURL }}" alt="" width="120" height="120">
                                            </a>
                                        </li>
                                    @empty
                                        <li class="else"> Please Upload 3 images, to be used for your school public webpage. Thank you.
                                        </li>
                                    @endforelse
                                </ul>
                            </div>
                        </div>
                    </div>
                </div><!-- /.box -->
            </div>
        </div>
    </section>
@stop