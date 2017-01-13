<!DOCTYPE html>
<html>
<!-- Start of edurepo Zendesk Widget script -->
<script>/*<![CDATA[*/window.zEmbed||function(e,t){var n,o,d,i,s,a=[],r=document.createElement("iframe");window.zEmbed=function(){a.push(arguments)},window.zE=window.zE||window.zEmbed,r.src="javascript:false",r.title="",r.role="presentation",(r.frameElement||r).style.cssText="display: none",d=document.getElementsByTagName("script"),d=d[d.length-1],d.parentNode.insertBefore(r,d),i=r.contentWindow,s=i.document;try{o=s}catch(c){n=document.domain,r.src='javascript:var d=document.open();d.domain="'+n+'";void(0);',o=s}o.open()._l=function(){var o=this.createElement("script");n&&(this.domain=n),o.id="js-iframe-async",o.src=e,this.t=+new Date,this.zendeskHost=t,this.zEQueue=a,this.body.appendChild(o)},o.write('<body onload="document._l();">'),o.close()}("https://assets.zendesk.com/embeddable_framework/main.js","edurepo.zendesk.com");/*]]>*/</script>
<!-- End of edurepo Zendesk Widget script -->
    <head>
        @include('includes.dashboard.head')
    </head>
    <body class="skin-blue sidebar-mini sidebar-collapse">
        <div class="wrapper">
            <header class="main-header">
                @include('includes.dashboard.header')
            </header>
            <aside class="main-sidebar">
                @include('includes.dashboard.sidebar')
            </aside>
            <div class="content-wrapper">
                @yield('content')
            </div>
            @include('includes.dashboard.footer')
        </div>
        @if(Route::currentRouteName() != 'school_compose')
            <div id="ajax-modal" class="modal fade" tabindex="-1" style="display: none;"></div>
        @endif
        {{--@include('includes.dashboard.control-sidebar')--}}
        <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.0/js/toastr.min.js"></script>
        {{ HTML::script('js/bootstrap.min.js'); }}
        {{ HTML::script('js/bootstrap-modalmanager.js'); }}
        {{ HTML::script('js/bootstrap-modal.js'); }}
        {{ HTML::script('js/jquery.tooltipster.min.js'); }}
        <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js" type="text/javascript"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js" type="text/javascript"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.6.0/fullcalendar.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/icheck.min.js"></script>
        {{ HTML::script('js/app.js'); }}
        {{ HTML::script('js/bootstrap-timepicker.min.js'); }}
        {{ HTML::script('js/onScreen.js'); }}
        {{ HTML::script('js/multiselect.min.js'); }}
        <script src="http://malsup.github.com/jquery.form.js"></script>
        {{ HTML::script('js/school-admin-dashboard.js'); }}
        {{ HTML::script('js/jquery.inputmask.js'); }}
        {{ HTML::script('js/owl.carousel.js'); }}
        {{ HTML::script('js/school-admin/school_vert.js'); }}
        {{ HTML::script('js/jquery.inputmask.date.extensions.js'); }}
        {{ HTML::script('js/jquery.inputmask.extensions.js'); }}
        {{ HTML::script('js/bootstrap-timepicker.min.js'); }}
        {{ HTML::script('plugins/fastclick/fastclick.min.js'); }}
        {{ HTML::script('plugins/sparkline/jquery.sparkline.min.js'); }}
        {{ HTML::script('plugins/jvectormap/jquery-jvectormap-1.2.2.min.js'); }}
        {{ HTML::script('plugins/jvectormap/jquery-jvectormap-world-mill-en.js'); }}
        {{ HTML::script('plugins/slimScroll/jquery.slimscroll.min.js'); }}
        {{ HTML::script('plugins/ionslider/ion.rangeSlider.min.js'); }}
        {{ HTML::script('plugins/dropzone/dropzone.js'); }}
        {{ HTML::script('js/school-admin/dropzone.js'); }}
        {{ HTML::script('https://cdn.jsdelivr.net/picturefill/2.3.1/picturefill.min.js'); }}
        {{ HTML::script('plugins/lightgallery/js/lightgallery.js'); }}
        {{ HTML::script('plugins/lightgallery/js/lg-fullscreen.js'); }}
        {{ HTML::script('plugins/lightgallery/js/lg-thumbnail.js'); }}
        {{ HTML::script('plugins/lightgallery/js/lg-video.js'); }}
        {{ HTML::script('plugins/lightgallery/js/lg-autoplay.js'); }}
        {{ HTML::script('plugins/lightgallery/js/lg-zoom.js'); }}
        {{ HTML::script('plugins/lightgallery/js/lg-hash.js'); }}
        {{ HTML::script('plugins/lightgallery/js/lg-pager.js'); }}
        {{ HTML::script('https://cdn.ckeditor.com/4.4.3/standard/ckeditor.js'); }}


        {{--{{ HTML::script('js/dashboard2.js'); }}--}}
    </body>
</html>
