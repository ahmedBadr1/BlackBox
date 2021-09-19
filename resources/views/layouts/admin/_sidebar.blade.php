<aside class="fb-side-d navbar-fixed-top "
       @if(app()->getLocale() == "ar")
       dir="rtl"
       @else
       dir="ltr"
    @endif
>
    <!-- Sidebar -->
    <a class="navbar-brand fb-nav-logo font-weight-bold text-uppercase" href="{{ url('/') }}">
        {{ config('app.name', 'Laravel') }}
    </a>
    <i class="fas fa-bars" id="menu"></i>
    <ul class="navbar-nav " id="accordionSidebar">
        <li class="nav-item nav-search">
            <i class="fas fa-search"></i>
            <input type="search" name="search" id="search" placeholder="{{__("names.search")}}" />
        </li>
        <!-- Nav Item - Dashboard -->
        <li class="nav-item">
            <a class="" href="{{route('dashboard')}}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>{{__("names.dashboard")}}</span>
                <span class="icon-name">{{__("names.dashboard")}}</span>
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
                    <span>{{__("names.users")}}</span>

                    <span class="icon-name">{{__("names.users")}}</span>
                    <span class="right-icon"><i class="fas fa-chevron-down"></i></span>
                </a>

                <div id="Roles" class="collapse" data-parent="#accordionSidebar">

                    <div class="py-2 collapse-inner rounded">
                        @can('user-show')
                            <a class="collapse-item " href="{{route('users.index')}}">{{__("names.manage")}} {{__("names.users")}}</a>
                        @endcan
                        @can('role-show')
                            <a class="collapse-item " href="{{route('roles.index')}}">{{__("names.manage")}} {{__("names.roles")}}</a>
                        @endcan
                        <a class="" href="{{route('sellers')}}">
                            <i class="fas fa-user-tie"></i>
                            <span>{{__("names.seller")}}</span>
                            <span class="icon-name">{{__("names.seller")}}</span>
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
                    <span>{{__("names.areas")}}</span>
                    <span class="icon-name">{{__("names.areas")}}</span>
                    <span class="right-icon"><i class="fas fa-chevron-down"></i></span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class=" py-2 collapse-inner rounded">
                        <a href="{{ route('areas.index') }}" class="collapse-item ">{{__("names.manage")}} {{__("names.areas")}}</a>
                        <a class="collapse-item " href="{{route('branches.index')}}">{{__("names.manage")}} {{__('names.branches')}}</a>

                        <a href="{{ route('zones.index') }}" class="collapse-item ">{{__("names.manage")}} {{__("names.zones")}}</a>
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
                <span>{{__('names.tasks')}}</span>
                <span class="icon-name">{{__('names.tasks')}}</span>
                <span class="right-icon"><i class="fas fa-chevron-down"></i></span>
            </a>
            <div id="collapseAnalysis" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                <a href="{{ route('areas.index') }}" class="collapse-item ">{{__("names.manage")}} {{__("names.tasks")}}</a>
                <a class="collapse-item " href="/charts.html"><span>{{__('names.jops')}}</span></a>
            </div>
        </li>


        <li class="nav-item">
            <a class="sidebar-link" href="#" data-toggle="collapse" data-target="#collapseStyles"
               aria-expanded="false" aria-controls="collapseStyles">
                <i class="fas fa-palette"></i>
                <span>{{__('names.accounting')}}</span>
                <span class="icon-name">{{__('names.accounting')}}</span>
                <span class="right-icon"><i class="fas fa-chevron-down"></i></span>
            </a>
            <div id="collapseStyles" class="collapse" aria-labelledby="headingUtilities"
                 data-parent="#accordionSidebar">
                <div class="py-2 collapse-inner rounded">
                    <a class="collapse-item" href="{{route('receipts.index')}}"><i class="fas fa-money-check "></i><span>{{__('names.receipts')}}</span></a>
                    <a class="collapse-item" href="{{route('mybalance')}}"><i class="fas fa-images"></i><span>{{__('names.mybalance')}}</span></a>
                    <a class="collapse-item" href="#"><i class="fas fa-images"></i><span>{{__('names.salary')}}</span></a>
                </div>
            </div>
        </li>


        <li class="nav-item">
            <a class="sidebar-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOreder"
               aria-expanded="false" aria-controls="collapseExample">
                <i class="fas fa-fw fa-chart-area"></i>
                <span>{{__('names.orders')}}</span>
                <span class="icon-name">{{__('names.orders')}}</span>
                <span class="right-icon"><i class="fas fa-chevron-down"></i></span>
            </a>
            <div id="collapseOreder" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                <a href="{{ route('orders.index') }}" class="collapse-item "><i class="fas fa-fw fa-box-open"></i>{{__("names.manage")}} {{__("names.orders")}}</a>
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
        <img src="/storage/{{ \Illuminate\Support\Facades\Auth::user()->profile->profile_photo ?? 'pics/profile.png'}}" alt="profile picture" />
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
