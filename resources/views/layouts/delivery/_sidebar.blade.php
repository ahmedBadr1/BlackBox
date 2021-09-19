<aside class="fb-side-d navbar-fixed-top text-light bg-dark bg-gradient"
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
        <div class="text-muted">
            Interface
        </div>
        <!-- Nav Item - Pages Collapse Menu -->

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="sidebar-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAnalysis"
               aria-expanded="false" aria-controls="collapseExample">
                <i class="fas fa-fw fa-chart-area"></i>
                <span>{{__('names.orders')}}</span>
                <span class="icon-name">{{__('names.orders')}}</span>
                <span class="right-icon"><i class="fas fa-chevron-down"></i></span>
            </a>
            <div id="collapseAnalysis" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                <a href="{{ route('myorders') }}" class="collapse-item "><i class="fas fa-fw fa-box-open"></i> {{__("names.my-orders")}}</a>
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
