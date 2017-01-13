@extends('layouts.mini-site-layouts')
@section('content')
    <div class="jumper" id="jump0">
    </div>
    <section id="hero" data-url="{{ $page_url }}" data-identifier="{{ $identifier }}">
        <div id="owl-main" class="owl-carousel height-lg owl-inner-nav owl-ui-lg">
            <div class="item" style="background-image:  url({{ isset($webimages[0])?$webimages[0]['openURL']:$web_defaults[0] }})">
                <div class="container">
                    <div class="caption vertical-center text-center">

                        <h1 class="fadeInDown-1 light-color">{{ $school->name }}</h1>
                        <p class="fadeInDown-2 medium-color">Create your online portfolio in minutes with the professionally designed Frittt responsive bootstrap template. </p>

                    </div><!-- /.caption -->
                </div><!-- /.container -->
            </div><!-- /.item -->

            <div class="item" style="background-image:  url({{ isset($webimages[1])?$webimages[1]['openURL']:$web_defaults[1] }})">
                <div class="container">
                    <div class="caption vertical-center text-center">

                        <h1 class="fadeInLeft-1 light-color">Built Using Bootstrap 3</h1>
                        <p class="fadeInLeft-2 light-color">Frittt is designed on the most popuplar framework by TWitter - Bootstrap 3. It comes with semantic & valid code with SEO friendly structure.</p>

                    </div><!-- /.caption -->
                </div><!-- /.container -->
            </div><!-- /.item -->

            <div class="item" style="background-image:  url({{ isset($webimages[2])?$webimages[2]['openURL']:$web_defaults[2] }})">
                <div class="container">
                    <div class="caption vertical-center text-center">

                        <h1 class="fadeInLeft-1 light-color">Handcrafted with care and love</h1>
                        <p class="fadeInLeft-2 light-color">Frittt free template is built to provide great user experience.</p>
                    </div><!-- /.caption -->
                </div><!-- /.container -->
            </div><!-- /.item -->
        </div><!-- /.owl-carousel -->
    </section>

    {{--About us--}}
    <div id="about" class="jumper">
    </div>

    <div class="sectionB0" id="about">

        <div class="container">
            <div class="section-headlines">
                <h4>About Us</h4>
                <div class="module-line"></div>
                <div class="section-intro">
                    We love creating innovative strategies for the web. All kind of brands hire us:
                    we make difficult things easy, but never take anything lightly.
                </div>
            </div>
        </div>
        <div class="row margin-0 position-relative">

            {{--<div class="col-xs-12 col-md-6 side-image"></div>--}}

            <div class="col-xs-12 col-md-12 col-md-offset-12 side-image-text">
                <div class="row">

                    <div class="col-sm-6">

                        <div class="iconboxleft">
                            <div class="iconboxleft-icon">
                                <span class="fa fa-plug"></span>
                            </div>
                            <div class="iconboxleft-text">
                                <h3 class="iconboxleft-title">Address</h3>
                                <div class="iconboxleft-desc">
                                    {{ $school->address}}
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="col-sm-6">

                        <div class="iconboxleft">
                            <div class="iconboxleft-icon">
                                <span class="fa fa-newspaper-o"></span>
                            </div>
                            <div class="iconboxleft-text">
                                <h3 class="iconboxleft-title">Phone</h3>
                                <div class="iconboxleft-desc">
                                    {{ isset($contact)?$contact->phone_1:"Not Available"}},
                                    {{ isset($contact)?$contact->phone_2:"Not Available"}}
                                </div>
                            </div>
                        </div>

                    </div>

                </div><!-- .row -->

                <div class="row">

                    <div class="col-sm-6">

                        <div class="iconboxleft">
                            <div class="iconboxleft-icon">
                                <span class="fa fa-language"></span>
                            </div>
                            <div class="iconboxleft-text">
                                <h3 class="iconboxleft-title">Emails</h3>
                                <div class="iconboxleft-desc">
                                    {{ isset($contact)?$contact->info_email:"Not Available" }},
                                    {{ isset($contact)?$contact->sale_email:"Not Available" }}
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="col-sm-6">

                        <div class="iconboxleft wow fadeInUp animated" data-wow-delay=".2s" style="visibility: visible; -webkit-animation: fadeInUp 0.2s;">
                            <div class="iconboxleft-icon">
                                <span class="fa fa-code"></span>
                            </div>
                            <div class="iconboxleft-text">
                                <h3 class="iconboxleft-title">Social Midia</h3>
                                <div class="iconboxleft-desc">
                                    {{ $school->facebook_page }}
                                </div>
                            </div>
                        </div>

                    </div>

                </div><!-- .row -->

            </div><!-- col-xs-12 -->

        </div><!-- .row -->
    </div>

    <div id="team" class="jumper">
    </div>
    <div class="section type-1" id="team">
        <div class="container">
            <div class="section-headlines">
                <h4>
                    Our Team</h4>
                <div class="module-line"></div>
                <div class="section-intro">
                    It is a long established fact that a reader will be distracted by the readable content
                    of a page when looking at its layout.
                </div>
            </div>


            <div class="row">
                <div class="col-lg-12">

                    <div id="team-carousel" class="carousel slide" data-ride="carousel" data-interval="9999999">

                        <!-- Indicators -->
                        <ol class="carousel-indicators">
                            <li data-target="#team-carousel" data-slide-to="0" class="active"></li>
                            <li data-target="#team-carousel" data-slide-to="1" class=""></li>
                            <li data-target="#team-carousel" data-slide-to="2" class=""></li>
                        </ol>

                        <!-- Wrapper for slides -->
                        <div class="carousel-inner">
                            <!-- Item 1 -->
                            <div class="item active">
                                <div class="cover-container">
                                    <div class="team-member-icon">
                                        <div class="person-avatar">
                                            <img src="{{ isset($teams[0])?$teams[0]['image_url']:'' }}" class="avatar size-default img-circle">
                                        </div>
                                    </div>
                                    <h2 class="team-member-title ">
                                        {{ isset($teams[0])?$teams[0]['name']:'' }}
                                    </h2>
                                    <h4>
                                        {{ isset($teams[0])?$teams[0]['position']:'' }}
                                    </h4>
                                    <p class="team-member-summary g-line-height-lg">
                                        {{ isset($teams[0])?$teams[0]['bio']:''}}
                                    </p>
                                </div>
                            </div>

                            <div class="item">
                                <div class="cover-container">
                                    <div class="team-member-icon">
                                        <div class="person-avatar">
                                            <img src="{{ isset($teams[1])?$teams[1]['image_url']:''}}" class="avatar size-default img-circle">
                                        </div>
                                    </div>
                                    <h2 class="team-member-title">
                                        {{ isset($teams[1])?$teams[1]['name']:'' }}
                                    </h2>
                                    <h4>
                                        {{ isset($teams[1])?$teams[1]['position']:'' }}
                                    </h4>
                                    <p class="team-member-summary g-line-height-lg">
                                        {{ isset($teams[1])?$teams[1]['bio']:''}}
                                    </p>
                                </div>
                            </div>
                            <div class="item">
                                <div class="cover-container">
                                    <div class="team-member-icon">
                                        <div class="person-avatar">
                                            <img src="{{ isset($teams[2])?$teams[2]['image_url']:''}}" class="avatar size-default img-circle">
                                        </div>
                                    </div>
                                    <h2 class="team-member-title ">
                                        {{ isset($teams[2])?$teams[2]['name']:'' }}
                                    </h2>
                                    <h4>
                                        {{ isset($teams[2])?$teams[2]['position']:'' }}
                                    </h4>
                                    <p class="team-member-summary g-line-height-lg">
                                        {{ isset($teams[2])?$teams[2]['bio']:''}}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Controls -->
                        <a class="left carousel-control" href="#team-carousel" role="button" data-slide="prev">
                            <span class="fa fa-chevron-left"></span>
                        </a>
                        <a class="right carousel-control" href="#team-carousel" role="button" data-slide="next">
                            <span class="fa fa-chevron-right"></span>
                        </a>
                    </div>

                </div>
            </div>
        </div>
        <!--end:.container-->
    </div>

    <div id="testimony" class="jumper">
    </div>
    <div class="section type-3">
        <div class="container">
            <div class="section-headlines">
                <h4>
                    Testimonials</h4>
                <div class="module-line"></div>
                <div class="section-intro">
                    We worked on digital strategies for 200 brands worldwide.
                </div>
            </div>
            <div id="carousel-testimonial" class="carousel slide bs-docs-carousel-example">
                <ol class="carousel-indicators">
                    <li data-target="#carousel-testimonial" data-slide-to="0" class=""></li>
                    <li data-target="#carousel-testimonial" data-slide-to="1" class=""></li>
                    <li data-target="#carousel-testimonial" data-slide-to="2" class=""></li>
                </ol>
                <div class="carousel-inner">

                    @if(isset($testimony[0]))
                        <div class="item active">
                            <div class="testimonial media">
                                <div class="testimonial-avatar pull-right hidden-xs	">
                                    <img src="{{ isset($testimony[0])?$testimony[0]['image_url']:"" }}" class="avatar size-default img-circle">
                                </div>
                                <div class="testimonial-content media-body">
                                    <p class="lead">
                                        {{ isset($testimony[0])?$testimony[0]['testimony']:'' }}
                                    </p>
                                    {{ isset($testimony[0])?$testimony[0]['name']:'' }}
                                </div>
                            </div>
                        </div>
                    @endif


                    @if(isset($testimony[1]))
                        <div class="item">
                            <div class="testimonial media">
                                <div class="testimonial-avatar pull-right hidden-xs	">
                                    <img src="{{ isset($testimony[1])?$testimony[1]['image_url']:""  }}" class="avatar size-default img-circle">
                                </div>
                                <div class="testimonial-content media-body">
                                    <p class="lead">
                                        {{ isset($testimony[1])?$testimony[1]['testimony']:'' }}
                                    </p>
                                    {{ isset($testimony[1])?$testimony[1]['name']:'' }}
                                </div>
                            </div>
                        </div>
                    @endif


                    @if(isset($testimony[1]))
                        <div class="item ">
                            <div class="testimonial media">
                                <div class="testimonial-avatar pull-right hidden-xs	">
                                    <img src="{{ isset($testimony[2])?$testimony[2]['image_url']:""  }}" class="avatar size-default img-circle">
                                </div>
                                <div class="testimonial-content media-body">
                                    <p class="lead">
                                        {{ isset($testimony[2])?$testimony[2]['testimony']:'' }}
                                    </p>
                                    {{ isset($testimony[2])?$testimony[2]['name']:'' }}
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="carousel-controller btn-group">
                    <a class="btn btn-small" href="#carousel-testimonial" data-slide="prev"><i
                                class="fa fa-chevron-left"></i></a><a class="btn btn-small" href="#carousel-testimonial"
                                                                      data-slide="next"><i class="fa fa-chevron-right"></i></a>
                </div>
            </div>
        </div>
    </div>

    <div id="contact" class="jumper">
    </div>
    <div class="section type-1 section-contact">
        <div class="container">
            <div class="section-headlines">
                <h2>
                    Contact Us</h2>
                    <div class="module-line"></div>
            </div>
            <form>
                <div class="row">
                    <div class="col-lg-4">
                        <address>
                            <div class="address-row">
                                <div class="social-network">
                                    <h3>Let's be friends!</h3>
                                    <ul class="social">
                                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                        <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                        <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
                                        <li><a href="#"><i class="fa fa-behance"></i></a></li>
                                        <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                                    </ul><!-- /.social -->
                                </div>


                            </div>
                        </address>
                        <div class="visible-xs visible-sm">
                            <br class="gap-30" />
                            <hr class="gap-divider" />
                            <br class="gap-30" />
                        </div>
                    </div>
                    <div class="col-lg-7 col-lg-offset-1">
                        <form role="form" method="post" action="#" id="contactform">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Your Name *"><br
                                                class="gap-15" />
                                    </div>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" id="email" name="email" placeholder="Your Email *"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="subject" name="subject" placeholder="Subject">
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" id="message" name="message" rows="8"></textarea>
                            </div>
                            <button id="button-send" class="btn btn-block btn-success">
                                Send Message Now
                            </button>
                            <div id="success">
                                Your message has been successfully!</div>
                            <div id="error">
                                Unable to send your message, please try later.</div>
                        </form>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div id="map"class="jumper"></div>
    <div id="mp" data-lat="{{ $school->lat }}" data-lng="{{ $school->lng }}"  data-name="{{ $school->name }}" style="height: 400px; width: 100%"></div>

    <div class="section section-half type-3 above-footer">
        <div class="container inner">
            <div class="row">
                <div class="col-md-3 col-sm-6 inner">
                    <h4>Who we are</h4>
                    <a href="javascript:"><img class="logo img-intext" src="img/logo.png" alt=""></a>
                    <p class="MT20">
                        It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.
                    </p>

                </div><!-- /.col -->

                <div class="col-md-3 col-sm-6 inner">
                    <h4>Latest works</h4>

                    <div class="row thumbs gap-xs">

                        <div class="col-xs-6 thumb">
                            <figure class="icon-overlay icn-link">
                                <a href="portfolio-post.html"><span class="icn-more"></span><img src="img/portfolio/place-1.jpg" alt=""></a>
                            </figure>
                        </div><!-- /.thumb -->

                        <div class="col-xs-6 thumb">
                            <figure class="icon-overlay icn-link">
                                <a href="portfolio-post.html"><span class="icn-more"></span><img src="img/portfolio/place-2.jpg" alt=""></a>
                            </figure>
                        </div><!-- /.thumb -->

                        <div class="col-xs-6 thumb">
                            <figure class="icon-overlay icn-link">
                                <a href="portfolio-post.html"><span class="icn-more"></span><img src="img/portfolio/place-3.jpg" alt=""></a>
                            </figure>
                        </div><!-- /.thumb -->

                        <div class="col-xs-6 thumb">
                            <figure class="icon-overlay icn-link">
                                <a href="portfolio-post.html"><span class="icn-more"></span><img src="img/portfolio/place-4.jpg" alt=""></a>
                            </figure>
                        </div><!-- /.thumb -->

                    </div><!-- /.row -->
                </div><!-- /.col -->
                <div class="col-md-3 col-sm-6 inner">
                    <h4>Get In Touch</h4>
                    <p>The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters.</p>
                    <ul class="contacts">
                        <li><i class="fa fa-map-marker"></i> 99 Green Street, White Plaza</li>
                        <li><i class="fa fa-mobile"></i> +1 123 456 8899</li>
                        <li><a href="javascript:"><i class="fa fa-envelope-o"></i> info@dummy.com</a></li>
                    </ul><!-- /.contacts -->
                </div><!-- /.col -->

                <div class="col-md-3 col-sm-6 inner">
                    <h4>Weekly Newsletter</h4>
                    <p>As opposed to using 'Content here, content here', making it look like readable English.</p>
                    <form id="newsletter" class="form-inline newsletter" role="form">
                        <label class="sr-only" for="exampleInputEmail">Email address</label>
                        <input type="email" class="form-control" id="exampleInputEmail" placeholder="Enter your email address">
                        <button type="submit" class="btn btn-default btn-small">Subscribe</button>
                    </form>
                </div><!-- /.col -->

            </div><!-- /.row -->
        </div>
    </div>
    <div id="disqus_thread" style="padding: 20px"></div>
@stop