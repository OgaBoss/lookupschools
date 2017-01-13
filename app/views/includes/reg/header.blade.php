<nav class="navbar navbar-inverse navbar-fixed-top home-nav" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">LookUp<span class="green">Schools</span></a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                @if(!Sentry::check())
                    @if(Route::currentRouteName() == 'admin_login')
                        <li><a href="/admin_login">Login</a></li>
                        <li><a href="/signup">Signup</a></li>
                    @else
                        <li><a href="/login">Login</a></li>
                        <li><a href="/signup">Signup</a></li>
                    @endif
                @elseif(Sentry::check() && isset($permissions['admin']) && $permissions['admin'] == 1)
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            {{ HTML::image(Sentry::getUser()->photo_url, 'User Image', array('class' => 'user-image')) }}
                            <span class="hidden-xs">{{Sentry::getUser()->first_name." ".Sentry::getUser()->last_name}}</span>
                        </a>
                    </li>
                    <li><a href="/admin/home">Dashboard Home</a></li>
                    <li><a href="/logout">Logout</a></li>
                @elseif(Sentry::check() && isset($permissions['user']) && $permissions['user'] == 1)
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            {{ HTML::image(Sentry::getUser()->photo_url, 'User Image', array('class' => 'user-image')) }}
                            <span class="hidden-xs">{{Sentry::getUser()->first_name." ".Sentry::getUser()->last_name}}</span>
                        </a>
                    </li>
                    <li><a href="/school/home">Dashboard Home</a></li>
                    <li><a href="/logout">Logout</a></li>
                @elseif(Sentry::check() && isset($permissions['guest']) && $permissions['guest'] == 1)
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            {{ HTML::image(Sentry::getUser()->photo_url, 'User Image', array('class' => 'user-image')) }}
                            <span class="hidden-xs">{{Sentry::getUser()->first_name." ".Sentry::getUser()->last_name}}</span>
                        </a>
                    </li>
                    <li><a href="/guest/home">Dashboard Home</a></li>
                    <li><a href="/logout">Logout</a></li>
                @endif
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>