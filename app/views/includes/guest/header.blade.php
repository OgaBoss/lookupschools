
<!--BEGIN TOPBAR-->
<div id="header-topbar-option-demo" class="page-header-topbar">
    <nav id="topbar" role="navigation" style="margin-bottom: 0;" data-step="3" class="navbar navbar-default navbar-static-top">
        <div class="navbar-header">
            <button type="button" data-toggle="collapse" data-target=".sidebar-collapse" class="navbar-toggle"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
            <a id="logo" href="/" class="navbar-brand"><span class="fa fa-rocket"></span><span class="logo-text">LookUpSchools</span><span style="display: none" class="logo-text-icon">µ</span></a></div>
        <div class="topbar-main">
            <ul class="nav navbar navbar-top-links navbar-right mbn">
                <li class="dropdown">
                    <a data-hover="dropdown" href="/guest/inbox" class="dropdown-toggle">
                        <i class="fa fa-envelope fa-fw"></i>
                        <span class="badge badge-orange"></span>
                    </a>
                </li>
                <li class="dropdown topbar-user"><a data-hover="dropdown" href="#" class="dropdown-toggle">
                        @if(!Sentry::getUser()->photo_url)
                            {{ HTML::image('/img/user.png', 'User Image', array('class' => 'img-responsive img-circle')) }}
                        @else
                            {{ HTML::image(Sentry::getUser()->photo_url, 'User Image', array('class' => 'img-circle')) }}
                        @endif
                            &nbsp;<span class="hidden-xs">

                            {{Sentry::getUser()->first_name." ".Sentry::getUser()->last_name}}
                        </span>&nbsp;<span class="caret"></span></a>
                    <ul class="dropdown-menu dropdown-user pull-right">
                        <li><a href="#"><i class="fa fa-user"></i>My Profile</a></li>
                        <li><a href="#"><i class="fa fa-university"></i>Schools</a></li>
                        @if(Route::currentRouteName() == 'guest_get_school')
                            <li><a href="/guest/{{ $school->slug }}/compose"><i class="fa fa-send-o"></i>Send Message</a></li>
                        @endif
                        <li><a href="/guest/inbox"><i class="fa fa-envelope"></i>My Inbox</a></li>
                        <li><a href="/guest/sent_message"><i class="fa fa-envelope"></i>Sent Messages</a></li>
                        <li class="divider"></li>
                        <li><a href="/logout"><i class="fa fa-key"></i>Log Out</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</div>
<!--END TOPBAR-->
