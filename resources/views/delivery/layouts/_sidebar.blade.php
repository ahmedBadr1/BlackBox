<!-- main-sidebar -->
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar sidebar-scroll sidebar-left">
    <div class="main-sidebar-header active">
        <h3 class="main-content-title mt-auto" ><b> <a href="{{url('/')}}" class="desktop-logo logo-light active nav-link ">{{sys('company_name')}}</a></b></h3>
        <h3 class="main-content-title mt-auto" ><b> <a href="{{url('/')}}" class="desktop-logo logo-dark  nav-link main-content-title">{{sys('company_name')}}</a></b></h3>
        {{--        <a class="desktop-logo logo-light active" href="{{ url('/') }}"><img--}}
        {{--                src="{{URL::asset('assets/img/brand/logo.png')}}" class="main-logo" alt="logo"></a>--}}
        {{--        <a class="desktop-logo logo-dark active" href="{{ url('/') }}"><img--}}
        {{--                src="{{URL::asset('assets/img/brand/logo-white.png')}}" class="main-logo dark-theme" alt="logo"></a>--}}
        {{--        <a class="logo-icon mobile-logo icon-light active" href="{{ url('/') }}"><img--}}
        {{--                src="{{URL::asset('assets/img/brand/favicon.png')}}" class="logo-icon" alt="logo"></a>--}}
        {{--        <a class="logo-icon mobile-logo icon-dark active" href="{{ url('/') }}"><img--}}
        {{--                src="{{URL::asset('assets/img/brand/favicon-white.png')}}" class="logo-icon dark-theme" alt="logo"></a>--}}
    </div>
    <div class="main-sidemenu">
        <div class="app-sidebar__user clearfix">
            <div class="dropdown user-pro-body">
                <div class="">
                    <a href="{{route('profile')}}">
                        <img  class="avatar avatar-xl brround"
                              @if($path = auth()->user()->profile->photo)
                              src="{{ '/storage/' .$path}}"
                              @else
                              src="/pics/profile.png"
                            @endif
                        >
                        <span
                            class="avatar-status profile-status bg-green"></span>
                    </a>
                </div>
                <div class="user-info">
                    <h4 class="font-weight-semibold mt-3 mb-0">{{ Auth::user()->name }}</h4>
                    <span class="mb-0 text-muted">{{ Auth::user()->profile->bio }}</span>
                </div>
            </div>
        </div>
        <ul class="side-menu">
            <li class="side-item side-item-category">@lang('names.main')</li>
            <li class="slide">

                <a class="side-menu__item" href="{{route('dashboard')}}">
                    <i class='bx bxs-dashboard side-menu__icon' ></i>
                    <span class="side-menu__label">@lang('names.dashboard')</span>
                    <span class="badge badge-success side-badge">1</span></a>
            </li>
            <li class="side-item side-item-category">@lang('names.interface')</li>

            <li class="slide">
                <a class="side-menu__item" data-toggle="slide">
                    <i class="bx bx-cart bx-sm side-menu__icon"></i>
                    <span class="side-menu__label">@lang('names.orders')</span>
                    <span class="right-icon"><i class="bx bxs-chevron-down side-menu__icon"></i></span>
                </a>
                <ul class="slide-menu">
                    <li><a class="slide-item" href="{{ route('delivery.my-orders') }}">@lang("names.my-orders")</a></li>
                </ul>
            </li>
            <li class="slide">
                <a class="side-menu__item" href="{{route('delivery.my-tasks')}}">
                    <i class="bx bx-task bx-sm side-menu__icon"></i>
                    <span class="side-menu__label">@lang("names.tasks")</span>
                </a>
            </li>

        </ul>
    </div>
</aside>
<!-- main-sidebar -->








