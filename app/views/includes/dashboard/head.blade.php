<head>
    <meta charset="UTF-8">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.4 -->
    {{ HTML::style('css/bootstrap.min.css') }}
    {{ HTML::style('css/bootstrap-timepicker.min.css') }}
    {{ HTML::style('css/bootstrap-modal-bs3patch.css') }}
    {{ HTML::style('css/bootstrap-modal.css') }}
    {{ HTML::style('css/tooltipster.css') }}
    {{ HTML::style('css/tooltipster-shadow.css') }}
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- jvectormap -->
    {{ HTML::style('plugins/jvectormap/jquery-jvectormap-1.2.2.css') }}
            <!-- Select2 -->
    <link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css" rel="stylesheet" />

            <!-- Theme style -->
    {{--<link href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.6.0/fullcalendar.print.css" rel="stylesheet" />--}}
    <link href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.6.0/fullcalendar.min.css" rel="stylesheet" />
    {{ HTML::style('css/admin.css') }}
    {{ HTML::style('css/modal.css') }}
    {{ HTML::style('css/school_admin_dashboard.css') }}
    {{ HTML::style('css/add_school.css') }}
    {{ HTML::style('css/common.css') }}
    {{ HTML::style('css/owl.carousel.css') }}
    {{ HTML::style('css/owl.theme.css') }}

    @if(Route::currentRouteName() != 'show_school_form')
        {{ HTML::style('css/form-edit.css') }}
    @endif


    <link rel="stylesheet" href="/plugins/ionslider/ion.rangeSlider.css">
    <link rel="stylesheet" href="/plugins/ionslider/ion.rangeSlider.skinFlat.css">
    <link rel="stylesheet" href="/plugins/dropzone/dropzone.css">
    <link rel="stylesheet" href="/plugins/dropzone/custom.css">
    <link rel="stylesheet" href="/css/image-upload.css">
    <link rel="stylesheet" href="/plugins/lightgallery/css/lightgallery.css">
    <link rel="stylesheet" href="/plugins/lightgallery/css/custom.css">
    <link rel="stylesheet" href="/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

    {{--{{ HTML::style('css/select2_bootstrap.css') }}--}}

    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    {{ HTML::style('css/_all-skins.css') }}
    {{ HTML::script('js/jquery-1.11.1.min.js'); }}

    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.0/js/toastr.min.js"></script>

    {{ HTML::style('plugins/iCheck/all.css') }}

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>