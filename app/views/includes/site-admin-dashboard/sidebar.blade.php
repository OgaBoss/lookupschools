<!-- Left side column. contains the logo and sidebar -->
<!-- sidebar: style can be found in sidebar.less -->
<section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
        <div class="pull-left image">
            @if(!Sentry::getUser()->photo_url)
                {{ HTML::image('/img/user.png', 'User Image', array('class' => 'img-circle')) }}
            @else
                {{ HTML::image(Sentry::getUser()->photo_url, 'User Image', array('class' => 'img-circle')) }}
            @endif
        </div>
        <div class="pull-left info">
            <p>{{Sentry::getUser()->first_name." ".Sentry::getUser()->last_name}}</p>
            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
    </div>
    <!-- sidebar menu: : style can be found in sidebar.less -->
</section>
<!-- /.sidebar -->
