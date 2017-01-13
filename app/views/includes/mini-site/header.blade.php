<header class="header" id="jump">
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
                    <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span><span
                            class="icon-bar"></span><span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">
                    <img src="{{ ($school->url_slug != "")  ? $school->url_slug : '/img/school-icon.png' }}" alt="" width="50" height="50" style="background-color: white"/></a>
            </div>
            <div class="collapse navbar-collapse hidden-xs">
                <ul class="nav navbar-nav navbar-right" style="padding-top: 12px;">
                    <li class="active"><a href="#home">Home</a></li>
                    <li><a href="#about">About Us</a></li>
                    <li><a href="#team">Our Team</a></li>
                    <li><a href="#testimony">Testimonials</a></li>
                    <li><a href="#contact">Contact Us</a></li>
                    <li><a href="#map">Map</a></li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
            <div class="collapse navbar-responsive-collapse">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="#home" data-toggle="collapse" data-target=".navbar-responsive-collapse">
                            Home</a></li>
                    <li><a href="#about" data-toggle="collapse" data-target=".navbar-responsive-collapse">
                            About Us</a></li>
                    <li><a href="#team" data-toggle="collapse" data-target=".navbar-responsive-collapse">
                            Team</a></li>
                    <li><a href="#test" data-toggle="collapse" data-target=".navbar-responsive-collapse">
                            Testiminials</a></li>
                    <li><a href="#contact" data-toggle="collapse" data-target=".navbar-responsive-collapse">
                            Contact</a></li>
                    <li><a href="#map" data-toggle="collapse" data-target=".navbar-responsive-collapse">
                            Map</a></li>
                </ul>
            </div>
            <!-- /.navbar-responsive-collapse -->
        </div>
    </nav>
</header>
<div class="jumper" id="jump0">
</div>