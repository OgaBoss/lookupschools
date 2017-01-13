<!DOCTYPE html>
<html>
<!-- Start of edurepo Zendesk Widget script -->
<script>/*<![CDATA[*/window.zEmbed||function(e,t){var n,o,d,i,s,a=[],r=document.createElement("iframe");window.zEmbed=function(){a.push(arguments)},window.zE=window.zE||window.zEmbed,r.src="javascript:false",r.title="",r.role="presentation",(r.frameElement||r).style.cssText="display: none",d=document.getElementsByTagName("script"),d=d[d.length-1],d.parentNode.insertBefore(r,d),i=r.contentWindow,s=i.document;try{o=s}catch(c){n=document.domain,r.src='javascript:var d=document.open();d.domain="'+n+'";void(0);',o=s}o.open()._l=function(){var o=this.createElement("script");n&&(this.domain=n),o.id="js-iframe-async",o.src=e,this.t=+new Date,this.zendeskHost=t,this.zEQueue=a,this.body.appendChild(o)},o.write('<body onload="document._l();">'),o.close()}("https://assets.zendesk.com/embeddable_framework/main.js","edurepo.zendesk.com");/*]]>*/</script>
<!-- End of edurepo Zendesk Widget script -->
<head>
    @include('includes.compare.head')
</head>
<body>
@include('includes.compare.header')
<div class="container">
    <div class="row map-criteria">
        <div class="col-md-4 criteria">
            <h4 class="school-name">Criteria</h4>
            <hr>
            <div class="row">
                <div class="col-md-6">
                    <input type="checkbox" name="sch-basic"  class="sch-basic" checked="checked" > Basic Information<br>
                    <input type="checkbox" name="sch-contact" class="sch-contact"  checked="checked"> Contact<br>
                    <input type="checkbox" name="sch-accre"  class="sch-accre" checked="checked"> Accreditations<br>
                    <input type="checkbox" name="sch-affi"  class="sch-affi" checked="checked"> Affiliations<br>
                    <input type="checkbox" name="sch-struc"  class="sch-struc" checked="checked"> School Structure<br>
                    <input type="checkbox" name="sch-extra"  class="sch-extra" checked="checked"> Extras<br>
                </div>
                <div class="col-md-6">
                    <ul class="fa-ul" style="margin-left: 0 !important;">
                        <li>
                            <a href="#"><i class="fa fa-toggle-on fa-2x toggle" ></i></a> <span class="toggle-text" style="padding-left: 20px !important; font-size: 1.4em !important;">Show all</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div id="map" style="height: 250px; width: 700px;"></div>
        </div>
    </div>
    {{ Toastr::render() }}
    @yield('content')
</div>
@include('includes.reg.footer')
<div id="ajax-modal" class="modal fade" tabindex="-1" style="display: none;"></div>
{{ HTML::script('js/jquery-1.11.1.min.js'); }}
{{ HTML::script('js/bootstrap.min.js'); }}
{{ HTML::script('js/bootstrap-modalmanager.js'); }}
{{ HTML::script('js/bootstrap-modal.js'); }}
{{ HTML::script('js/jquery.tooltipster.min.js'); }}
<script src="http://maps.google.com/maps/api/js?sensor=true"></script>
{{ HTML::script('js/compare.js'); }}
</body>
</html>