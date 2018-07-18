<?php
/**
 * Created by PhpStorm.
 * User: Esther
 * Date: 1/23/2018
 * Time: 7:31 AM
 */?>
<header class="main-header">

    <!-- Logo -->
    <a href="{{ route('admin.index') }}" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b> MF </b> - A</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b> {{ setting('admin_site_title') }} </b> - Admin </span>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- Messages: style can be found in dropdown.less-->
                {{--     <li class="dropdown messages-menu">
                         <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                             <i class="fa fa-envelope-o"></i>
                             <span class="label label-success">4</span>
                         </a>
                         <ul class="dropdown-menu">
                             <li class="header">You have 4 messages</li>
                             <li>
                                 <!-- inner menu: contains the actual data -->
                                 <ul class="menu">
                                     <li><!-- start message -->
                                         <a href="#">
                                             <div class="pull-left">
                                                 <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                                             </div>
                                             <h4>
                                                 Support Team
                                                 <small><i class="fa fa-clock-o"></i> 5 mins</small>
                                             </h4>
                                             <p>Why not buy a new awesome theme?</p>
                                         </a>
                                     </li>
                                     <!-- end message -->
                                     <li>
                                         <a href="#">
                                             <div class="pull-left">
                                                 <img src="dist/img/user3-128x128.jpg" class="img-circle" alt="User Image">
                                             </div>
                                             <h4>
                                                 AdminLTE Design Team
                                                 <small><i class="fa fa-clock-o"></i> 2 hours</small>
                                             </h4>
                                             <p>Why not buy a new awesome theme?</p>
                                         </a>
                                     </li>
                                     <li>
                                         <a href="#">
                                             <div class="pull-left">
                                                 <img src="dist/img/user4-128x128.jpg" class="img-circle" alt="User Image">
                                             </div>
                                             <h4>
                                                 Developers
                                                 <small><i class="fa fa-clock-o"></i> Today</small>
                                             </h4>
                                             <p>Why not buy a new awesome theme?</p>
                                         </a>
                                     </li>
                                     <li>
                                         <a href="#">
                                             <div class="pull-left">
                                                 <img src="dist/img/user3-128x128.jpg" class="img-circle" alt="User Image">
                                             </div>
                                             <h4>
                                                 Sales Department
                                                 <small><i class="fa fa-clock-o"></i> Yesterday</small>
                                             </h4>
                                             <p>Why not buy a new awesome theme?</p>
                                         </a>
                                     </li>
                                     <li>
                                         <a href="#">
                                             <div class="pull-left">
                                                 <img src="dist/img/user4-128x128.jpg" class="img-circle" alt="User Image">
                                             </div>
                                             <h4>
                                                 Reviewers
                                                 <small><i class="fa fa-clock-o"></i> 2 days</small>
                                             </h4>
                                             <p>Why not buy a new awesome theme?</p>
                                         </a>
                                     </li>
                                 </ul>
                             </li>
                             <li class="footer"><a href="#">See All Messages</a></li>
                         </ul>
                     </li>--}}
                <!-- Notifications: style can be found in dropdown.less -->
                <li class="dropdown notifications-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-bell-o"></i>
{{--                        <span class="label label-warning">{{ count(Auth::guard('admin')->user()->unreadNotifications) }}</span>--}}
                    </a>
                    <ul class="dropdown-menu">
{{--                        <li class="header">You have {{ count(Auth::guard('admin')->user()->unreadNotifications) }} notifications</li>--}}
   {{--                     <li>
                            <!-- inner menu: contains the actual data -->
                            <ul class="menu">
                                @foreach(Auth::guard('admin')->user()->unreadNotifications as $notice)
                                    @if($notice->getAttribute('type') == 'Marathonfd\Notifications\NewMemberNotification')
                                        <li>
                                            <a href="{{ url('/admin/notification') }}">
                                                <i class="fa fa-users text-aqua"></i> 5 {{ $notice->getAttribute('data')['title'] }} }}
                                            </a>
                                        </li>
                                    @endif
                                @endforeach
                                @foreach(Auth::guard('admin')->user()->unreadNotifications as $notice)
                                    @if($notice->getAttribute('type') == 'Marathonfd\Notifications\PaymentRequestNotification')
                                        <li>
                                            <a href="{{ url('/admin/notification') }}">
                                                <i class="fa fa-info text-green"></i>
                                                Hey!, New {{ $notice->getAttribute('data')['title'] }}
                                            </a>
                                        </li>
                                    @endif
                                @endforeach
                                @foreach(Auth::guard('admin')->user()->unreadNotifications as $notice)
                                    @if($notice->getAttribute('type') == 'Marathonfd\Notifications\UpgradeNotification')
                                        <li>
                                            <a href="{{ url('/admin/notification') }}">
                                                <i class="fa fa-shopping-cart text-green"></i> {{ $notice->getAttribute('data')['title'] }}
                                            </a>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </li>--}}
                {{--        @if(Auth::guard('admin')->user()->notifications()->count() != 0)
                            <li class="footer"><a href="{{ url('/admin/notification/delete') }}">Clear all</a></li>
                        @endif--}}
                    </ul>
                </li>
                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        @if(Auth::guard('admin')->check())
                            <div class="profile" style="display: inline">{{ Auth::guard('admin')->user()->name  }} &nbsp
                                <img src="{{ Auth::guard('admin')->user()->photo }}" class="img-circle" style="max-width: 25px" alt="{{ Auth::guard('admin')->user()->name }}">
                            </div>
                        @endif
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            @if(Auth::guard('admin')->check())
                                <img src="{{ Auth::guard('admin')->user()->photo }}" class="img-circle" alt="{{ Auth::guard('admin')->user()->name }}">
                                <p>{{ Auth::guard('admin')->user()->name  }}</p>
                                <small>{{ Auth::guard('admin')->user()->created_at->diffForHumans() }}</small>
                            @endif
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="{{ route('admin.admins.show',Auth::guard('admin')->id()) }}" class="btn btn-default btn-flat">Profile</a>
                            </div>
                            <div class="pull-right">
                                <a href="{{ route('admin.logout') }}" class="btn btn-default btn-flat">Sign out</a>
                            </div>
                        </li>
                    </ul>
                </li>
                <!-- Control Sidebar Toggle Button -->
                <li>
                    <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                </li>
            </ul>
        </div>

    </nav>
</header>

