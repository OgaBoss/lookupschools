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
        <li>
            <a href="/school/show_school">
                <i class="fa fa-plus-square"></i>
                <span>Add School</span><small class="label pull-right bg-green"></small>
            </a>
        </li>
    </ul>
</section>