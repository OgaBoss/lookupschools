<!-- Left side column. contains the logo and sidebar -->
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                @if(!Sentry::getUser()->photo_url)
                    {{ HTML::image('/img/user.png', 'User Image', array('class' => 'img-circle user_profile_pic')) }}
                @else
                    {{ HTML::image(Sentry::getUser()->photo_url, 'User Image', array('class' => 'img-circle user_profile_pic')) }}
                @endif
            </div>
            <div class="pull-left info">
                <p>{{Sentry::getUser()->first_name." ".Sentry::getUser()->last_name}}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">SCHOOL DATA</li>

            @if(Route::currentRouteName() == 'get_school')
                <li class="active">
            @else
                <li>
            @endif
                <a href="/school/{{ $school->slug }}/basic_information">
                    <i class="fa fa-dashboard"></i> <span>Basic Info</span>
                </a>
            </li>
            @if(Route::currentRouteName() == 'school_contact')
                <li class="active">
            @else
                <li>
            @endif
                <a href="/school/{{ $school->slug }}/school_contact">
                    <i class="fa fa-map-marker"></i>
                    <span>Contact</span>
                </a>
            </li>
            @if(Route::currentRouteName() == 'school_structure')
                <li class="active">
            @else
                <li>
            @endif
                <a href="/school/{{ $school->slug }}/school_structure">
                    <i class="fa fa-sitemap"></i>
                    <span>School Structure</span>
                </a>
            </li>
            @if(Route::currentRouteName() == 'school_accreditation')
                <li class="active">
            @else
                <li>
            @endif
                <a href="/school/{{ $school->slug }}/school_accreditation">
                    <i class="fa fa-registered"></i>
                    <span>Accreditation</span>
                </a>
            </li>
            @if(Route::currentRouteName() == 'school_affiliation')
                <li class="active">
            @else
                <li>
            @endif
                <a href="/school/{{ $school->slug }}/school_affiliation">
                    <i class="fa fa-users"></i>
                    <span>Affiliations</span>
                </a>
            </li>
            @if($school->school_type == 'preschool' || $school->school_type == 'primary' || $school->school_type == 'secondary')
                @if(Route::currentRouteName() == 'pps_school_extras')
                    <li class="active">
                @else
                    <li>
                @endif
                    <a href="/school/{{ $school->slug }}/pps_school_extras">
                        <i class="fa fa-plus"></i>
                        <span>Extras</span>
                    </a>
                </li>
            @endif

            @if($school->school_type == 'tertiary' || $school->school_type == 'vocation')
                @if(Route::currentRouteName() == 'tv_school_extras')
                    <li class="active">
                @else
                    <li>
                @endif
                    <a href="/school/{{ $school->slug }}/tv_school_extras">
                        <i class="fa fa-plus"></i>
                        <span>Extras</span>
                    </a>
                </li>

                @if(Route::currentRouteName() == 'faculty_courses')
                    <li class="active">
                @else
                    <li>
                @endif
                    <a href="/school/{{ $school->slug }}/faculty_courses">
                        <i class="fa fa-university"></i>
                        <span>Faculty and Courses</span>
                    </a>
                </li>
            @endif

            @if(Route::currentRouteName() == 'new_user')
                <li class="active">
            @else
                <li>
            @endif
                <a href="/school/{{ $school->slug }}/new_user">
                    <i class="fa fa-user-plus"></i>
                    <span>Create Users</span>
                </a>
            </li>

            <li class="header">OTHERS</li>
            @if(Route::currentRouteName() == 'school_inbox' || Route::currentRouteName() == 'school_compose')
                <li class="active">
            @else
                <li>
            @endif
                <a href="/school/{{ $school->slug }}/inbox">
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
                        <a href="/school/inbox">Inbox <span class="label label-primary pull-right sidebar_msg_count"></span></a>
                    </li>
                        @if(Route::currentRouteName() == 'school_compose')
                            <li class="active">
                        @else
                            <li>
                        @endif
                            <a href="/school/{{ $school->slug }}/compose">Compose</a></li>
                    <li><a href="/school/sent_message">Sent </a></li>
                </ul>
            </li>
            @if(Route::currentRouteName() == 'page_image_upload')
                <li class="active">
            @else
                <li>
            @endif
                <a href="/school/{{ $school->slug }}/page_image_upload">
                    <i class="fa fa-files-o"></i>
                    <span>Add Images</span>
                </a>

            </li>
            @if(Route::currentRouteName() == 'school_events')
                <li class="active">
            @else
                <li>
            @endif
                <a href="/school/{{ $school->slug }}/events">
                    <i class="fa fa-th"></i>
                    <span>Add Events</span>
                </a>
            </li>
            @if(Route::currentRouteName() == 'all_ads')
                <li class="active">
            @else
                <li>
            @endif
                <a href="/advert/{{ $school->slug }}/adverts">
                    <i class="fa fa-shopping-cart"></i>
                    <span>Adverts</span>
                </a>
            </li>
            @if(Route::currentRouteName() == 'billing')
                <li class="active">
            @else
                <li>
            @endif
                <a href="/school/{{ $school->slug }}/billing">
                    <i class="fa fa-money"></i>
                    <span>Billing</span>
                </a>
            </li>

            @if(Route::currentRouteName() == 'web_page')
                <li class="active">
            @else
                <li>
            @endif
                <a href="/school/{{ $school->slug }}/web_page">
                    <i class="fa fa-globe"></i>
                    <span>WebSite Data</span>
                </a>
            </li>

            {{--<li class="header">LABELS</li>--}}
            {{--<li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Important</span></a></li>--}}
            {{--<li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Warning</span></a></li>--}}
            {{--<li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li>--}}
        </ul>
    </section>
    <!-- /.sidebar -->
