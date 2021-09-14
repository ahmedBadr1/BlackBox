<aside class="fb-side-d navbar-fixed-top ">
    <!-- Sidebar -->
    <a class="navbar-brand fb-nav-logo font-weight-bold text-uppercase" href="{{ url('/') }}">
        {{ config('app.name', 'Laravel') }}
    </a>
    <i class="fas fa-bars" id="menu"></i>
    <ul class="navbar-nav " id="accordionSidebar">
        <li class="nav-item nav-search">
            <i class="fas fa-search"></i>
            <input type="search" name="search" id="search" placeholder="search here..." />
        </li>
        <!-- Nav Item - Dashboard -->
        <li class="nav-item">
            <a class="" href="{{route('dashboard')}}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span>
                <span class="icon-name">Dashboard</span>
            </a>
        </li>

        <!-- Heading -->
        <div class=" text-muted">
            Controls
        </div>
    @canany(['user-show','role-show'])
        <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item ">
                <a class="sidebar-link" href="#" data-toggle="collapse" data-target="#Roles" aria-expanded="false"
                   aria-controls="collapseTwo">
                    <i class="fas fa-users"></i>
                    <span>Users</span>

                    <span class="icon-name">Users</span>
                    <span class="right-icon"><i class="fas fa-chevron-down"></i></span>
                </a>

                <div id="Roles" class="collapse" data-parent="#accordionSidebar">

                    <div class="py-2 collapse-inner rounded">
                        @can('user-show')
                            <a class="collapse-item " href="{{route('users.index')}}">Manage Users</a>
                        @endcan
                        @can('role-show')
                            <a class="collapse-item " href="{{route('roles.index')}}">Manage Roles</a>
                        @endcan
                        <a class="" href="{{route('clients')}}">
                            <i class="fas fa-user-tie"></i>
                            <span>clients</span>
                            <span class="icon-name">clients</span>
                        </a>
                    </div>
                </div>
            </li>
    @endcanany
    @can('area-show')
        <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="sidebar-link" href="#" data-toggle="collapse" data-target="#collapsePages"
                   aria-expanded="false" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-folder-open"></i>
                    <span>Requests</span>
                    <span class="icon-name">Requests</span>
                    <span class="right-icon"><i class="fas fa-chevron-down"></i></span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class=" py-2 collapse-inner rounded">
                        <a href="{{ route('areas.index') }}" class="collapse-item ">Manage Requests</a>
                        <a href="{{ route('areas.index') }}" class="collapse-item ">Manage Areas</a>
                        <a href="{{ route('areas.index') }}" class="collapse-item ">Contact</a>
                    </div>
                </div>
            </li>
    @endcan
    <!-- Heading -->
        <div class="text-muted">
            Interface
        </div>
        <!-- Nav Item - Pages Collapse Menu -->




        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="sidebar-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAnalysis"
               aria-expanded="false" aria-controls="collapseExample">
                <i class="fas fa-fw fa-chart-area"></i>
                <span>Analysis</span>
                <span class="icon-name">Analysis</span>
                <span class="right-icon"><i class="fas fa-chevron-down"></i></span>
            </a>
            <div id="collapseAnalysis" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                <a class="collapse-item " href="/charts.html"><span>Charts</span></a>
                <a class="collapse-item " href="/charts.html"><span>Counter</span></a>
            </div>
        </li>


        <li class="nav-item">
            <a class="sidebar-link" href="#" data-toggle="collapse" data-target="#collapseStyles"
               aria-expanded="false" aria-controls="collapseStyles">
                <i class="fas fa-palette"></i>
                <span>Styles</span>
                <span class="icon-name">Styles</span>
                <span class="right-icon"><i class="fas fa-chevron-down"></i></span>
            </a>
            <div id="collapseStyles" class="collapse" aria-labelledby="headingUtilities"
                 data-parent="#accordionSidebar">
                <div class="py-2 collapse-inner rounded">
                    <a class="collapse-item" href="#"><i class="fas fa-swatchbook"></i><span>Theme</span></a>
                    <a class="collapse-item" href="#"><i class="fas fa-images"></i><span>Posters</span></a>
                </div>
            </div>
        </li>

        <!-- Nav Item - Tables -->
{{--        @can('inbox')--}}
{{--            <li class="nav-item">--}}
{{--                <a class="" href="{{route('inbox')}}">--}}
{{--                    <i class="fas fa-inbox  "></i>--}}
{{--                    <span>Inbox</span>--}}
{{--                    <span class="icon-name">Inbox</span>--}}
{{--                </a>--}}
{{--            </li>--}}
{{--        @endcan--}}
{{--        --}}{{--        @can('email')--}}
{{--        <li class="nav-item">--}}
{{--            <a class="" href="{{route('email')}}">--}}
{{--                <i class="fas fa-envelope"></i>--}}
{{--                <span>Email</span>--}}
{{--                <span class="icon-name">Email</span>--}}
{{--            </a>--}}
{{--        </li>--}}
{{--    --}}{{--        @endcan--}}


    <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

    </ul>

    <div class="profile-inf">
        <img src="/pics/profile.png" alt="profile picture" />
        <div class="fb-info">

            <a href="{{url('/profile')}}" class="fb-username">{{ Auth::user()->name }}</a>
            <div class="fb-bio">Feedbacker</div>
        </div>


        <a href="{{ route('logout') }}"
           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
            <i class="fas fa-sign-out-alt" id="logout"></i>
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>

    </div>

</aside>
<!-- End of Sidebar -->
