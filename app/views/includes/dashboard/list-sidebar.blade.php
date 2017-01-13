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
        @if(Route::currentRouteName() != 'administrator')
            @if(Route::currentRouteName() == 'school_dashboard')
                <li class="treeview active">
            @else
                <li class="treeview">
            @endif
                <a href="/school/home">
                    <i class="fa fa-graduation-cap"></i>
                    <span>Schools</span>
                    <span class="fa fa-angle-left pull-right"></span>
                </a>
                <ul class="treeview-menu">
                    @foreach($schools as $school)
                        <li>
                            <a href="/school/{{$school->slug}}/basic_information">
                                <i class="fa fa-circle-o"></i>
                                <span>{{ substr($school->name, 0, 15).'..' }}</span><small class="label pull-right bg-green">{{ $school->school_type }}</small>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </li>

            @if(Route::currentRouteName() == 'show_school_form')
                <li class="active">
            @else
                <li>
            @endif
                <a href="/school/show_school">
                    <i class="fa fa-plus-square"></i>
                    <span>Add School</span><small class="label pull-right bg-green"></small>
                </a>
            </li>

            @if(Route::currentRouteName() == 'school_inbox')
                <li class="active">
            @else
                <li>
            @endif
                <a href="/school/inbox">
                    <i class="fa fa-envelope"></i>
                    <span>Messaging</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    @if(Route::currentRouteName() == 'school_inbox' )
                        <li class="active">
                    @else
                        <li>
                    @endif
                            <a href="/school/inbox">Inbox <span class="label label-primary pull-right inbox-msg-count"></span></a>
                        </li>
                        <li><a href="/school/sent_message">Sent</a></li>
                </ul>
            </li>
        @endif
    </ul>
</section>