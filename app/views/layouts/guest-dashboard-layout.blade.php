<!DOCTYPE html>
<html>
<head>
    @include('includes.guest.head')
</head>
<body>
    <div>
        @include('includes.guest.header')
        <div id="wrapper">
            {{--@include('includes.guest.sidebar')--}}
            <div id="page-wrapper">
                {{ Toastr::render() }}
                @yield('content')
                @include('includes.guest.footer')
            </div>
        </div>
    </div>
    <div id="ajax-modal" class="modal fade" tabindex="-1" style="display: none;"></div>

    {{--<div id="ajax-modal" class="modal fade col-md-4" tabindex="-1" style="display: none;"></div>--}}
    {{ HTML::script('js/guest/jquery-1.10.2.min.js'); }}
    {{ HTML::script('https://cdn.ckeditor.com/4.4.3/standard/ckeditor.js'); }}
    {{ HTML::script('js/guest/jquery-migrate-1.2.1.min.js'); }}
    {{ HTML::script('js/guest/bootstrap.min.js'); }}
    {{ HTML::script('js/bootstrap-modalmanager.js'); }}
    {{ HTML::script('js/bootstrap-modal.js'); }}
    {{ HTML::script('js/guest/bootstrap-hover-dropdown.js'); }}
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.0/js/toastr.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js" type="text/javascript"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.6.0/fullcalendar.min.js"></script>
    {{ HTML::script('js/guest/html5shiv.js'); }}
    {{ HTML::script('js/guest/respond.min.js'); }}
    {{ HTML::script('js/guest/jquery.metisMenu.js'); }}
    {{ HTML::script('js/guest/jquery.slimscroll.js'); }}
    {{ HTML::script('js/guest/jquery.cookie.js'); }}
    {{ HTML::script('js/guest/icheck.min.js'); }}
    {{ HTML::script('js/guest/custom.min.js'); }}
    {{ HTML::script('js/guest/jquery.news-ticker.js'); }}
    {{ HTML::script('js/guest/jquery.menu.js'); }}
    {{ HTML::script('js/guest/pace.min.js'); }}
    {{ HTML::script('js/guest/holder.js'); }}
    {{ HTML::script('js/guest/responsive-tabs.js'); }}
    {{ HTML::script('js/guest/jquery.flot.js'); }}
    {{ HTML::script('js/guest/jquery.flot.categories.js'); }}
    {{ HTML::script('js/guest/jquery.flot.pie.js'); }}
    {{ HTML::script('js/guest/jquery.flot.tooltip.js'); }}
    {{ HTML::script('js/guest/jquery.flot.resize.js'); }}
    {{ HTML::script('js/guest/jquery.flot.fillbetween.js'); }}
    {{ HTML::script('js/guest/jquery.flot.stack.js'); }}
    {{ HTML::script('js/guest/jquery.flot.spline.js'); }}
    {{ HTML::script('js/guest/zabuto_calendar.min.js'); }}
    {{--{{ HTML::script('js/guest/index.js'); }}--}}

    {{--<!--LOADING SCRIPTS FOR CHARTS-->--}}
    {{--{{ HTML::script('js/guest/highcharts.js'); }}--}}
    {{--{{ HTML::script('js/guest/data.js'); }}--}}
    {{--{{ HTML::script('js/guest/drilldown.js'); }}--}}
    {{--{{ HTML::script('js/guest/exporting.js'); }}--}}
    {{--{{ HTML::script('js/guest/highcharts-more.js'); }}--}}
    {{--{{ HTML::script('js/guest/charts-highchart-pie.js'); }}--}}
    {{--{{ HTML::script('js/guest/charts-highchart-more.js'); }}--}}

    <!--CORE JAVASCRIPT-->
    {{ HTML::script('js/guest/main.js'); }}
    {{ HTML::script('js/guest/messaging.js'); }}
</body>
</html>