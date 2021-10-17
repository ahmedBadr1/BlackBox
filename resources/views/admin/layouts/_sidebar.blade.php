<aside class="fb-side-d navbar-fixed-top "
       @if(app()->getLocale() == "ar")
       dir="rtl"
       @else
       dir="ltr"
    @endif
>
    <!-- Sidebar -->
    <a class="navbar-brand fb-nav-logo font-weight-bold text-uppercase" href="{{ url('/') }}">
        {{ setting('company_name') ?? config('app.name', 'Laravel') }}
    </a>
    <i class="fas fa-bars" id="menu"></i>
    <ul class="navbar-nav " id="accordionSidebar">
        <li class="nav-item nav-search">
            <i class="fas fa-search"></i>
            <input type="search" name="search" id="search" placeholder="{{__("names.search")}}" />
        </li>
        <!-- Nav Item - Dashboard -->
        <li class="nav-item">
            <a class="" href="{{route('admin.dashboard')}}">
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
                            <a class="collapse-item " href="{{route('admin.users.index')}}">{{__("names.manage")}} {{__("names.users")}}</a>
                        @endcan
                        @can('role-show')
                            <a class="collapse-item " href="{{route('admin.roles.index')}}">{{__("names.manage")}} {{__("names.roles")}}</a>
                        @endcan
                        <a class="" href="{{route('admin.sellers')}}">
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
                        <a href="{{ route('admin.areas.index') }}" class="collapse-item ">{{__("names.manage")}} {{__("names.areas")}}</a>
                        <a class="collapse-item " href="{{route('admin.branches.index')}}">{{__("names.manage")}} {{__('names.branches')}}</a>

                        <a href="{{ route('admin.zones.index') }}" class="collapse-item ">{{__("names.manage")}} {{__("names.zones")}}</a>
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
                <a href="{{ route('admin.tasks.index') }}" class="collapse-item ">{{__("names.manage")}} {{__("names.tasks")}}</a>
                <a class="collapse-item " href="{{ route('admin.locations.index') }}"><i class="fas fa-map-marker-alt"></i><span>{{__('names.locations')}}</span></a>
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
                    <a class="collapse-item" href="{{route('admin.receipts.index')}}"><i class="fas fa-money-check "></i><span>{{__('names.receipts')}}</span></a>

                    <a class="collapse-item" href="{{route('admin.financials')}}"><i class="fas fa-images"></i><span>{{__('names.financials')}}</span></a>
                    <a class="collapse-item" href="{{route('admin.statics')}}"><i class="fas fa-chart-line"></i><span>{{__('names.statics')}}</span></a>
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
                <a href="{{ route('admin.orders.index') }}" class="collapse-item "><i class="fas fa-fw fa-box-open"></i>{{__("names.manage")}} {{__("names.orders")}}</a>
                <a href="{{route('admin.packing')}}"><i class="fas fa-fw fa-box"></i> {{__("names.manage")}} {{__("names.packing")}}</a>
            </div>
        </li>

        <li class="nav-item">
            <a href="{{ route('admin.plans.index') }}" class="sidebar-link"><i class="fas fa-fw fa-tags"></i>{{__("names.manage")}} {{__("names.plans")}}</a>

        </li>
        <li class="nav-item">
            <a class="sidebar-link" href="{{route('admin.help')}}"><i class="fas fa-question-circle"></i><span>{{__('names.help')}}</span></a>
        </li>
        <li class="nav-item">
            <a class="sidebar-link" href="{{route('admin.setting')}}"><i class="fas fa-cogs"></i><span>{{__('names.setting')}}</span></a>
        </li>
        <li class="nav-item">
            <a class="sidebar-link" href="{{route('admin.trash')}}"><i class="fas fa-trash-restore-alt"></i><span>{{__('names.trash')}}</span></a>
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
        <img src="/storage/{{ auth()->user()->profile->profile_photo ?? 'pics/profile.png'}}" alt="profile picture" />
        <div class="fb-info">

            <a href="{{route('admin.profile')}}" class="fb-username">{{ auth()->user()->name}}</a>
            <div class="fb-bio">{{ auth()->user()->profile->bio }}</div>
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
