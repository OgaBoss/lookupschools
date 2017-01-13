<!DOCTYPE html>
<html>
    <head>
        @include('includes.mini-site.head')
    </head>
    <body>
        @include('includes.mini-site.header')
        <div class="wrapper">
            {{ Toastr::render() }}
            @yield('content')
        </div>

        {{--@include('includes.reg.footer')--}}
        {{ HTML::script('js/mini-site/jquery-1.10.2.min.js') }}
        {{ HTML::script('js/mini-site/bootstrap.min.js') }}
        {{ HTML::script('js/mini-site/jquery.easing.1.3.js') }}
        {{ HTML::script('js/mini-site/jquery.fancybox.pack.js') }}
        {{ HTML::script('js/mini-site/jquery.mixitup.min.js') }}
        {{ HTML::script('js/mini-site/jquery.smooth-scroll.min.js') }}
        {{ HTML::script('js/mini-site/modernizr.js') }}
        {{ HTML::script('js/mini-site/owl.carousel.min.js') }}
        {{ HTML::script('js/mini-site/custom.js') }}
        <script src="http://maps.google.com/maps/api/js?sensor=true"></script>
        {{ HTML::script('js/gsmaps.js') }}
        <script id="dsq-count-scr" src="//lookupschools.disqus.com/count.js" async></script>
        <script>
            /**
             * RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
             * LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables
             */
            var disqus_config = function () {
                this.page.url = $('#hero').attr('data-url'); // Replace PAGE_URL with your page's canonical URL variable
                this.page.identifier = $('#hero').attr('data-identifier'); // Replace PAGE_IDENTIFIER with your page's unique identifier variable
            };

            (function() { // DON'T EDIT BELOW THIS LINE
                var d = document, s = d.createElement('script');

                s.src = '//lookupschools.disqus.com/embed.js';

                s.setAttribute('data-timestamp', +new Date());
                (d.head || d.body).appendChild(s);
            })();
        </script>
        <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript" rel="nofollow">comments powered by Disqus.</a></noscript>
        <script>
            $(document).ready(function(){
                var lat = $('#mp').attr('data-lat');
                var lng = $('#mp').attr('data-lng');
                var name = $('#mp').attr('data-name');

               var map = new GMaps({
                    div: '#mp',
                    lat: lat,
                    lng: lng,
                    //zoom: 16,
                   scrollwheel: false
               });

                map.addMarker({
                    lat: lat,
                    lng: lng,
                    title: name,
                    scrollwheel: false
                })
            });
        </script>
    </body>
</html>