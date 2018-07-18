    <!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                @if(Auth::guard('admin')->check())
                    <img src="{{ Auth::guard('admin')->user()->photo }}" class="img-circle" alt="{{ Auth::guard('admin')->user()->fullname }}">
                    <p>{{ Auth::guard('admin')->user()->name  }}</p>
                @endif
            </div>
            <div class="pull-left info">
                @if(Auth::guard('admin')->check())
                <p>{{ Auth::guard('admin')->user()->name }}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                @endif
            </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>
            <li class="active treeview menu-open">
                <a href="{{ route('admin.index') }}">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            <span class="pull-right-container">
            </span>
                </a>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-newspaper-o"></i> <span>Events</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('admin.events.index') }}"><i class="fa fa-bank"></i>
                            <span>Events</span>
                            <span class="pull-right-container"></span>
                        </a>
                    </li>
                    <li><a href="{{ route('admin.events.reg.index') }}"><i class="fa fa-circle-o"></i>Events Registration</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-money"></i>
                    <span>Sermons</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('admin.category.index') }}"><i class="fa fa-circle-o"></i>Category</a></li>
                    <li><a href="{{ route('admin.sermon.index') }}"><i class="fa fa-circle-o"></i>Sermons</a></li>
                    <li> <a href="{{ route('admin.sermon.comments') }}"><i class="fa fa-bell-o"></i>
                            <span>Comment(s)</span><span class="pull-right-container">
                                <small class="label pull-right bg-red">{{ @$new_sermon_comment_count }}</small>
                            </span>
                        </a>
                    </li>
                </ul>
            </li>
            <li><a href="{{ route('admin.subscribers') }}"><i class="fa fa-group"></i>Subscribers</a></li>
            <li>
                <a href="{{ route('admin.admins.index') }}">
                    <i class="fa fa-user-o"></i> <span>Admin</span>
                </a>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-money"></i>
                    <span>Testimonies</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="{{ route('admin.testimony.index') }}">
                            <i class="fa fa-comments-o"></i> <span>Testimony</span>
                        </a>
                    </li>
                    <li> <a href="{{ route('admin.testimony.comments') }}"><i class="fa fa-bell-o"></i>
                            <span>Comment(s)</span><span class="pull-right-container">
                                <small class="label pull-right bg-red">{{ @$new_testimony_comment_count }}</small>
                            </span>
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="{{ route('admin.contact.index') }}">
                    <i class="fa fa-inbox"></i> <span>Mailbox</span>
              <span class="pull-right-container">
              <small class="label pull-right bg-red">{{ @$message_count }}</small>
            </span>
                </a>
            </li>

            <li>
                <a href="{{ route('admin.prayer-requests.index') }}">
                    <i class="fa fa-bell-o"></i> <span>Prayer Requests</span>
              <span class="pull-right-container">
              <small class="label pull-right bg-red">{{ @$prayer_requests_count }}</small>
            </span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.projects.index') }}">
                    <i class="fa fa-stack-exchange"></i> <span>Church Projects</span>
                </a>
            </li>

            <li>
                <a href="{{--{{ url('/admin/media') }}--}}">
                    <i class="fa fa-upload"></i> <span>Media</span>
                </a>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-cloud"></i> <span>Gallery</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('admin.gallery-categories.index') }}"><i class="fa fa-circle-o"></i>Category</a></li>
                    <li><a href="{{ route('admin.galleries.index') }}"><i class="fa fa-circle-o"></i>Galleries</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-newspaper-o"></i> <span>Post</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('admin.categories.index') }}"><i class="fa fa-circle-o"></i>Category</a></li>
                    <li><a href="{{ route('admin.posts.index') }}"><i class="fa fa-circle-o"></i>Posts</a></li>
                    <li> <a href="{{ route('admin.posts.comments') }}"><i class="fa fa-bell-o"></i>
                            <span>Comment(s)</span><span class="pull-right-container">
                                <small class="label pull-right bg-red">{{ @$new_post_comment_count }}</small>
                            </span>
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="{{ route('admin.staffs.index') }}">
                    <i class="fa fa-group"></i> <span>Staffs</span>
                </a>
            </li>
            <li><a href="{{ route('admin.settings.index') }}"><i class="fa fa-cog"></i> <span>Settings</span></a></li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
