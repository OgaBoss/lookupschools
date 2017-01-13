@extends('layouts.default')
@section('content')
    <!--HOME SECTION-->
    <section id="home">
        <div id="Home">
            <div class="container">
                <div class="row">
                    <div class="col-md-10 col-md-offset-1 centered">
                        <h1>The Best Search Engine  <span>For The Schools Around you</span></h1>
                        <div class="subscribe">
                            {{Form::open(array('class' => 'form-horizontal', 'route' => 'show_results', 'method' => 'get'))}}
                                <div class="form-group state-dropdown">
                                    <select class="form-control select2" id="home-dropdown" name="state">
                                        <option></option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-subscribe">SEARCH SCHOOLS</button>
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--END HOME SECTION-->



    <!-- SERVICES SECTION-->
    <aside id="services">
        <div class="services">
            <div class="container">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 title text-center">
                    <h2>Services</h2>
                </div>
                <div class="row text-center">
                    @foreach($services as $service)
                        <article class="col-md-4">
                            <div class="service-box" data-animated="fadeInUp">
                                <div class="icon-box">
                                    <i class="icon-document"></i>
                                </div>
                                <div class="description-box">
                                    <h4>{{ $service->post_title }}</h4>
                                    <p>{{ $service->post_content }}</p>
                                </div>
                            </div>
                        </article>
                    @endforeach

                </div>
            </div>
        </div>
    </aside>
    <!--END SERVICES SECTION-->

<!-- ABOUT SECTION-->
<section id="Adverts">
    <div class="About">
        <div class="container-fluid">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 title text-center">
                <h2>Featured Schools</h2>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="owl_carousel_2">
                        @foreach($schools_adds as $school_ad )
                            <div class="item">
                                <img src="{{ isset($school_ad->url_slug) ? $school_ad->url_slug : "/img/school-icon.png" }}" alt="" class="adverts">
                                <span class="feature-name">{{ $school_ad->name }}</span>
                            </div>
                        @endforeach

                        @foreach($v_list as $list)
                            <div class="item video-feature">
                                <a href="#" class="modal-ad" data-v="{{ $list[0] }}" data-school-name="{{ $list[2]->name }}">
                                    <img src="{{ isset($list[1]) ? $list[1] : "/img/school-icon.png" }}" alt="" class="adverts">
                                </a>
                                <span class="feature-name">{{ $list[2]->name }}</span>
                                <span class="video-click">click image to play video</span>
                            </div>
                        @endforeach
                        <div >{{ HTML::image('/img/logo_1.png', 'User Image', array('class' => 'adverts')) }}</div>
                        <div>{{ HTML::image('/img/logo_2.png', 'User Image', array('class' => 'adverts')) }}</div>
                        <div>{{ HTML::image('/img/logo_3.png', 'User Image', array('class' => 'adverts')) }}</div>
                        <div><iframe class="adverts" src="//www.youtube.com/embed/ubGpDoyJvmI" frameborder="0" allowfullscreen></iframe></div>
                        <div>
                            {{ HTML::image('/img/logo_1.png', 'User Image', array('class' => 'adverts')) }}
                        </div>
                        <div>{{ HTML::image('/img/logo_2.png', 'User Image', array('class' => 'adverts')) }}</div>
                        <div>{{ HTML::image('/img/logo_3.png', 'User Image', array('class' => 'adverts')) }}</div>
                        <div>{{ HTML::image('/img/logo_4.png', 'User Image', array('class' => 'adverts')) }}</div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

    <!-- FEATURES SECTION-->
    <section id="Features">
        <div class="Features">
            <div class="container">
                <div class="row text-center">

                    <div class="col-md-6" data-animated="fadeInLeft">
                        {{--<img class="img-responsive" alt="ipad Mockup" src="/img/black-child-new.jpg">--}}
                    </div>

                    <div class="col-md-6 text-left">
                        <h2>We have different services to help you</h2>
                        <p>Dantes remained confused and silent by this explanation of the thoughts which had unconsciously been working in his mind, or rather soul; for there are two distinct sorts of ideas, those that proceed from the head and those from the heart.</p>

                        <div class="FeaturesCol4" data-animated="fadeInUp">
                            <div class="FeaturesLeft">
                                <span class="icon-lightbulb"></span>
                            </div>
                            <div class="FeaturesRight">
                                <h3>Look great on any devices</h3>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                                </p>
                            </div>
                        </div>
                        <div class="FeaturesCol4" data-animated="fadeInUp">
                            <div class="FeaturesLeft">
                                <span class="icon-strategy"></span>
                            </div>
                            <div class="FeaturesRight">
                                <h3>Very easy to customize</h3>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                                </p>
                            </div>
                        </div>
                        <div class="FeaturesCol4" data-animated="fadeInUp">
                            <div class="FeaturesLeft">
                                <span class="icon-layers"></span>
                            </div>
                            <div class="FeaturesRight">
                                <h3>Quick support respond</h3>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                                </p>
                            </div>
                        </div>

                    </div>


                </div>
            </div>
        </div>
    </section>
    <!--END FEATURES SECTION-->


    <!--END ABOUT SECTION-->

    <!-- PRICING SECTION-->
    <section id="Pricing">
        <div class="Pricing">
            <div class="container">

                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 title text-center">
                    <h2>Pricing</h2>
                    <p>Mauris blandit aliquet elit, eget tincidunt nibh pulvinar onec rutrum congue</p>
                </div>

                <div class="row">
                    <div class="pricing-table-block clearfix">
                        <div class="col-sm-4 col-xs-12 " data-animated="fadeInUp">
                            <div class="pricing-table">
                                <div class="pricing-head">
                                    <span class="star"><i class="fa fa-star"></i></span>
                                    <h4 class="h4 pricing-title">Basic</h4>
                                    <span class="pricing-txt-recommend">#</span>
                                </div>
                                <div class="pricing-body">
                                    <div class="pricing-cost">
                                        <span class="pricing-unit">$</span>
                                        <span class="pricing-number">19</span>
                                    </div>
                                    <div class="pricing-features">
                                        <ul>
                                            <li>Full Analytic</li>
                                            <li>Mobile Site and Store</li>
                                            <li>24h Support</li>
                                            <li>Unlimited Email Accounts</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="pricing-footer">
                                    <a class="btn btn-pricing" href="#">sign up</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4 col-xs-12 " data-animated="fadeInUp">
                            <div class="pricing-table pricing-recommend">
                                <div class="pricing-head">
                                    <span class="star"><i class="fa fa-star"></i></span>
                                    <h4 class="h4 pricing-title">Standard</h4>
                                    <span class="pricing-txt-recommend">Recommend</span>
                                </div>
                                <div class="pricing-body">
                                    <div class="pricing-cost">
                                        <span class="pricing-unit">$</span>
                                        <span class="pricing-number">29</span>
                                    </div>
                                    <div class="pricing-features">
                                        <ul>
                                            <li>Full Analytic</li>
                                            <li>Mobile Site and Store</li>
                                            <li>24h Support</li>
                                            <li>Unlimited Email Accounts</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="pricing-footer">
                                    <a class="btn btn-pricing" href="#">sign up</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4 col-xs-12 " data-animated="fadeInUp">
                            <div class="pricing-table">
                                <div class="pricing-head">
                                    <span class="star"><i class="fa fa-star"></i></span>
                                    <h4 class="h4 pricing-title">Pro</h4>
                                    <span class="pricing-txt-recommend">#</span>
                                </div>
                                <div class="pricing-body">
                                    <div class="pricing-cost">
                                        <span class="pricing-unit">$</span>
                                        <span class="pricing-number">39</span>
                                    </div>
                                    <div class="pricing-features">
                                        <ul>
                                            <li>Full Analytic</li>
                                            <li>Mobile Site and Store</li>
                                            <li>24h Support</li>
                                            <li>Unlimited Email Accounts</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="pricing-footer">
                                    <a class="btn btn-pricing" href="#">sign up</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--END PRICING SECTION-->

    <!-- FAQ SECTION-->
    <section id="faq">
        <div class="faq">
            <div class="container">

                <div class="row">
                    <h2 class="text-center ask">FREQUENTLY ASKED QUESTIONS</h2>
                    <div class="col-md-5 col-md-offset-1" data-animated="fadeInLeft">
                        <h4>What is Lorem Ipsum?</h4>
                        <p class="Answer">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
                        <h4 class="Question">Why use Lorem Ipsum?</h4>
                        <p class="Answer">Lorem ipsum dolor sit amet, in mea nonumes dissentias dissentiunt, pro te solet oratio iriure. Cu sit consetetur moderatius intellegam, ius decore accusamus te. Ne primis suavitate disputando nam. Mutat convenirete.</p>
                        <h4 class="Question">How many variations exist?</h4>
                        <p class="Answer">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
                    </div>
                    <!--/col-md-5 -->

                    <div class="col-md-5" data-animated="fadeInRight">
                        <h4>Is safe use Lorem Ipsum?</h4>
                        <p class="Answer">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
                        <h4 class="Question">When can be used?</h4>
                        <p class="Answer">Lorem ipsum dolor sit amet, in mea nonumes dissentias dissentiunt, pro te solet oratio iriure. Cu sit consetetur moderatius intellegam, ius decore accusamus te. Ne primis suavitate disputando nam. Mutat convenirete.</p>
                        <h4 class="Question">License &amp; Copyright</h4>
                        <p class="Answer">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
                    </div>
                    <!--/col-md-5-->
                </div>

            </div>
        </div>
    </section>
    <!--END FAQ SECTION-->

    <!-- TESTIMONIALS SECTION-->
    <section id="testimonials">
        <div class="testimonials">
            <div class="container">

                <div class="row">

                    <div class="col-md-6 info" data-animated="fadeInUp">
                        <h3>WHAT THE PEOPLE THINK ABOUT US</h3>
                        <p>Lorem ipsum dolor sit amet, in mea nonumes dissentias dissentiunt, pro te solet oratio iriure. Cu sit consetetur moderatius intellegam, ius decore accusamus te. Ne primis suavitate disputando nam. Mutat convenire te mel, id adhuc reprehendunt est. At sea justo elitr, eos in solum mucius.</p>
                        <p>Lessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae. Cu sit consetetur moderatius intellegam, ius decore accusamus te.</p>
                        <p>Et harum quidem rerum facilis est et expedita distinctiod quod maxime placeat facere possimus.</p>
                    </div>


                    <div class="col-md-6">
                        <div id="testimonials-carousel">
                            <div class="item">
                                <div class="row">
                                    <div class="col-xs-10 col-xs-offset-1" data-animated="fadeInUp">
                                        <img src="images/testimonials/1.jpg" class="img-circle img-responsive img-centered" alt="">
                                        <p><i class="fa fa-quote-left"></i> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nam, molestias, quae, eligendi perspiciatis architecto dicta recusandae dolorem modi quidem.</p>
                                        <p class="name">- Johnson Doe, Microsoft
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="item">
                                <div class="row">
                                    <div class="col-xs-10 col-xs-offset-1">
                                        <img src="images/testimonials/2.jpg" class="img-circle img-responsive img-centered" alt="">
                                        <p><i class="fa fa-quote-left"></i> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nam, molestias, quae, eligendi perspiciatis architecto dicta recusandae dolorem modi quidem.</p>
                                        <p class="name">- Karen Rovitic, NerdCo
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="item">
                                <div class="row">
                                    <div class="col-xs-10 col-xs-offset-1">
                                        <img src="images/testimonials/3.jpg" class="img-circle img-responsive img-centered" alt="">
                                        <p><i class="fa fa-quote-left"></i> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nam, molestias, quae, eligendi perspiciatis architecto dicta recusandae dolorem modi quidem.</p>
                                        <p class="name">- John Doe, FashionCo
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>

            </div>
        </div>

    </section>
    <!--END TESTIMONIALS SECTION-->

    <!--CONTACT SECTION-->
    <section id="Contact">
        <div class="container">
            <div class="row contact">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 title text-center">
                    <h2>Contact Us</h2>
                    <p>Mauris blandit aliquet elit, eget tincidunt nibh pulvinar onec rutrum congue</p>
                </div>

                <div class="col-md-6 contactLeft" data-animated="fadeInUp">
                    <!-- contact FORM-->

                    <div class="contactForm">

                        <!--MAIN FORM-->

                        {{Form::open(array('class' => 'help form-horizontal', 'method' => 'post', 'route' => 'send_email'))}}

                            <div class="form-group">
                                <input name="name" type="text" class="form-control" placeholder="Name* :" id="name" required data-validation-required-message="Please enter your name.">
                                <p class="help-block text-danger"></p>
                            </div>

                            <div class="form-group">
                                <input name="email" type="email" class="form-control" placeholder="E-mail* :" id="email" required data-validation-required-message="Please enter your email address.">
                                <p class="help-block text-danger"></p>
                            </div>

                            <div class="form-group">
                                <input name="subject" type="text" class="form-control" placeholder="Subject* :" id="phone" required data-validation-required-message="Please enter your phone number.">
                                <p class="help-block text-danger"></p>
                            </div>

                            <div class="form-group">
                                <textarea name="message" class="form-control" placeholder="Message* :" id="message" rows="3" cols="40" required data-validation-required-message="Please enter a message."></textarea>
                                <p class="help-block text-danger"></p>
                            </div>

                            <div id="success"></div>
                            <button type="submit" class="submit" data-animated="bounceIn">Send Message</button>
                        {{ Form::close() }}
                        <!--END Main form-->

                    </div>
                    <!-- END contact FORM-->

                </div>

                <div class="col-md-6 contactRight" data-animated="fadeInUp">

                    <div class="contacDetails">
                        <div class="icon icon-map"></div>
                        <h3>Contact details</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse tincidunt, dui ac porta.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse tincidunt, dui ac porta.Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        <p data-animation-delay="0" data-animated="fadeInUp"> <i class="fa fa-map-marker fa-lg"></i> Some Street West Victoria 1234 Australia</p>
                        <p data-animation-delay="0.1" data-animated="fadeInUp"> <i class="fa fa-mobile fa-lg"></i> +1800 1234 56789</p>
                        <p data-animation-delay="0" data-animated="fadeInUp"> <i class="fa fa-envelope-o"></i> support@websitename.com</p>
                        <p data-animation-delay="0" data-animated="fadeInUp"> <i class="fa fa-link"></i> www.websitename.com</p>
                    </div>

                </div>

            </div>
        </div>
    </section>
    <!--END CONTACT SECTION-->
@stop
