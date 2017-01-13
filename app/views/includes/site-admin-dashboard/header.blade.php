
{{--{{Sentry::getUser()->email}}--}}
        <!-- Logo -->
<a href="/" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini"><b>LU</b>S</span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg"><b>LookUp</b>School</span>
</a>

<!-- Header Navbar: style can be found in header.less -->
<nav class="navbar navbar-static-top" role="navigation">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
    </a>
    <!-- Navbar Right Menu -->
    <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
            <!-- Messages: style can be found in dropdown.less-->
            <li class="dropdown messages-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-envelope-o"></i>
                    <span class="label label-success">4</span>
                </a>
                <ul class="dropdown-menu">
                    <li class="header">You have 4 messages</li>
                    {{--<li class="footer"><a href="#">See All Messages</a></li>--}}
                </ul>
            </li>
            <!-- Notifications: style can be found in dropdown.less -->


            <!-- Tasks: style can be found in dropdown.less -->
            <li class="dropdown tasks-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-flag-o"></i>
                    <span class="label label-danger data-level">9</span>
                </a>

            </li>
            <!-- User Account: style can be found in dropdown.less -->
            <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    @if(!Sentry::getUser()->photo_url)
                        {{ HTML::image('/img/user.png', 'User Image', array('class' => 'user-image')) }}
                    @else
                        {{ HTML::image(Sentry::getUser()->photo_url, 'User Image', array('class' => 'user-image')) }}
                    @endif
                    <span class="hidden-xs">{{Sentry::getUser()->first_name." ".Sentry::getUser()->last_name}}</span>
                </a>
                <ul class="dropdown-menu">
                    <!-- User image -->
                    <li class="user-header">
                        @if(!Sentry::getUser()->photo_url)
                            {{ HTML::image('/img/user.png', 'User Image', array('class' => 'img-circle')) }}
                        @else
                            {{ HTML::image(Sentry::getUser()->photo_url, 'User Image', array('class' => 'img-circle')) }}
                        @endif
                        <p>
                            {{Sentry::getUser()->first_name." ".Sentry::getUser()->last_name}}
                            <small>Member since {{date("F jS, Y",strtotime(Sentry::getUser()->created_at))}}</small>
                        </p>
                    </li>
                    <!-- Menu Footer-->
                    <li class="user-footer">
                        <div class="pull-left">
                            <i class="fa fa-gears"></i>
                            <a href="#" class="">Profile</a>
                        </div>
                        <div class="pull-right">
                            <i class="fa fa-sign-out"></i>
                            <a href="/logout" class="">Logout</a>
                        </div>
                    </li>
                </ul>
            </li>
            <!-- Control Sidebar Toggle Button -->
            {{--<li>--}}
            {{--<a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>--}}
            {{--@include('includes.dashboard.control-sidebar')--}}
            {{--</li>--}}
        </ul>
    </div>
</nav>
