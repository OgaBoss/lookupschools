<!DOCTYPE html>
<html>
<!-- Start of edurepo Zendesk Widget script -->
<script>/*<![CDATA[*/window.zEmbed||function(e,t){var n,o,d,i,s,a=[],r=document.createElement("iframe");window.zEmbed=function(){a.push(arguments)},window.zE=window.zE||window.zEmbed,r.src="javascript:false",r.title="",r.role="presentation",(r.frameElement||r).style.cssText="display: none",d=document.getElementsByTagName("script"),d=d[d.length-1],d.parentNode.insertBefore(r,d),i=r.contentWindow,s=i.document;try{o=s}catch(c){n=document.domain,r.src='javascript:var d=document.open();d.domain="'+n+'";void(0);',o=s}o.open()._l=function(){var o=this.createElement("script");n&&(this.domain=n),o.id="js-iframe-async",o.src=e,this.t=+new Date,this.zendeskHost=t,this.zEQueue=a,this.body.appendChild(o)},o.write('<body onload="document._l();">'),o.close()}("https://assets.zendesk.com/embeddable_framework/main.js","edurepo.zendesk.com");/*]]>*/</script>
<!-- End of edurepo Zendesk Widget script -->
    <head>
        @include('includes.site-admin-dashboard.head')
    </head>
    <body class="skin-green sidebar-mini">
        <div class="wrapper">
            <header class="main-header">
                @include('includes.site-admin-dashboard.header')
            </header>
            <aside class="main-sidebar">
                @if(Route::currentRouteName() == 'admin_dashboard')
                    @include('includes.site-admin-dashboard.sidebar')
                @elseif(Route::currentRouteName() == 'site_data' || Route::currentRouteName() == 'data_get' )
                    @include('includes.site-admin-dashboard.data.sidebar')
                @elseif(Route::currentRouteName() == 'admin_advert' || Route::currentRouteName() == 'billing')
                    @include('includes.site-admin-dashboard.advert.sidebar')
                @elseif(Route::currentRouteName() == 'users' || Route::currentRouteName() == 'admins' || Route::currentRouteName() == 'guest' || Route::currentRouteName() == 'search_user'   )
                    @include('includes.site-admin-dashboard.users.sidebar')
                @endif
            </aside>
            <div class="content-wrapper">
                {{ Toastr::render() }}
                @yield('content')
            </div>
            @include('includes.site-admin-dashboard.footer')
        </div>
        <div id="ajax-modal" class="modal fade col-md-4" tabindex="-1" style="display: none;"></div>
        {{--@include('includes.dashboard.control-sidebar')--}}
        {{ HTML::script('js/jquery-1.11.1.min.js'); }}
        {{ HTML::script('plugins/datatables/jquery.dataTables.js'); }}
        <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.0/js/toastr.min.js"></script>
        {{ HTML::script('js/bootstrap.min.js'); }}
        {{ HTML::script('js/bootstrap-modalmanager.js'); }}
        {{ HTML::script('js/bootstrap-modal.js'); }}
        {{ HTML::script('js/jquery.tooltipster.min.js'); }}
        <script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>
        {{ HTML::script('js/app.js'); }}
        {{ HTML::script('js/admin-dashboard.js'); }}
        {{ HTML::script('js/onScreen.js'); }}
        {{--{{ HTML::script('js/school-admin-dashboard.js'); }}--}}
        {{ HTML::script('js/jquery.inputmask.js'); }}
        {{ HTML::script('js/jquery.inputmask.date.extensions.js'); }}
        {{ HTML::script('js/jquery.inputmask.extensions.js'); }}
        {{ HTML::script('js/bootstrap-timepicker.min.js'); }}
        {{ HTML::script('plugins/fastclick/fastclick.min.js'); }}
        {{ HTML::script('plugins/datatables/dataTables.bootstrap.min.js'); }}
        {{ HTML::script('plugins/sparkline/jquery.sparkline.min.js'); }}
        {{ HTML::script('plugins/jvectormap/jquery-jvectormap-1.2.2.min.js'); }}
        {{ HTML::script('plugins/jvectormap/jquery-jvectormap-world-mill-en.js'); }}
        {{ HTML::script('plugins/slimScroll/jquery.slimscroll.min.js'); }}
        {{--{{ HTML::script('js/dashboard2.js'); }}--}}
    </body>
</html>