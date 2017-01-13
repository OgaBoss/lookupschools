<section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
        <div class="pull-left image">
            @if(!Sentry::getUser()->photo_url)
                {{ HTML::image('/img/user.png', 'User Image', array('class' => 'img-circle')) }}
            @else
                {{ HTML::image(Sentry::getUser()->photo_url, 'User Image', array('class' => 'img-circle')) }}
            @endif                        </div>
        <div class="pull-left info">
            <p>{{Sentry::getUser()->first_name." ".Sentry::getUser()->last_name}}</p>
            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
    </div>

    <!-- /.search form -->
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        @if(Route::currentRouteName() == 'users')
            <li class="active">
        @else
            <li>
        @endif
            <a href="/admin/users">
                <i class="fa fa-university"></i>
                <span>School Admin</span><small class="label pull-right bg-green"></small>
            </a>
        </li>

            @if(Route::currentRouteName() == 'guest')
                <li class="active">
            @else
                <li>
            @endif
            <a href="/admin/guest">
                <i class="fa fa-user-secret"></i>
                <span>Guest</span><small class="label pull-right bg-green"></small>
            </a>
        </li>

        @if(Route::currentRouteName() == 'admins')
            <li class="active">
        @else
            <li>
        @endif
            <a href="/admin/admins">
                <i class="fa fa-lock"></i>
                <span>Site Admin</span><small class="label pull-right bg-green"></small>
            </a>
        </li>

        @if(Route::currentRouteName() == 'search_user')
            <li class="active">
        @else
            <li>
                @endif
                <a href="/admin/search_user">
                    <i class="fa fa-search"></i>
                    <span>Search User</span><small class="label pull-right bg-green"></small>
                </a>
            </li>
    </ul>
</section>