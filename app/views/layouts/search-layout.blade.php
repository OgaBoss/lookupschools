<!DOCTYPE html>
<html>
    <head>
        @include('includes.search.head')
    </head>

    <body style="padding-bottom: 50px!important;">
    <div id="fb-root"></div>
    <script>(function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.5&appId=394549237401780";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>

        <div class="wrapper container-fluid">
            @include('includes.search.header')

            {{ Toastr::render() }}
            @yield('content')
        </div>
        <div id="map-view"></div>
        <div id="ajax-modal" class="modal fade col-md-4" tabindex="-1" style="display: none;"></div>
        <div id="ajax_modal_compare" class="modal fade col-md-4" tabindex="-1" style="display: none;"></div>
        <div id="fb-root"></div>
        <div id="map" style="width: 1000px;"></div>
        @include('includes.reg.footer')
        {{ HTML::script('js/jquery-1.11.1.min.js'); }}
        {{ HTML::script('js/bootstrap.min.js'); }}
        {{ HTML::script('js/bootstrap-modal.js'); }}
        {{ HTML::script('js/jquery.tooltipster.min.js'); }}
        {{ HTML::script('js/bootstrap-modalmanager.js'); }}
        {{ HTML::script('js/select2.full.js'); }}
        <script src="http://maps.google.com/maps/api/js?sensor=true"></script>
        {{ HTML::script('js/gsmaps.js'); }}
        {{ HTML::script('js/app.js'); }}
        {{ HTML::script('js/search.js'); }}
        {{ HTML::script('plugins/ionslider/ion.rangeSlider.min.js'); }}

    </body>
</html>