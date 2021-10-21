<!-- main-sidebar -->
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar sidebar-scroll">
    <div class="main-sidebar-header active">
        <h3 class="text-center w-100" ><b> <a href="{{url('/')}}" class="desktop-logo logo-light active nav-link main-content-title">{{setting('company_name')}}</a></b></h3>
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
                        <img alt="user-img" class="avatar avatar-xl brround"
                             src="/storage/{{ \Illuminate\Support\Facades\Auth::user()->profile->profile_photo ?? 'pics/profile.png'}}"><span
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
                <a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}">
                    <i class='bx bx-basket side-menu__icon' ></i>
                    <span class="side-menu__label">@lang('names.orders')</span><i class="angle fe fe-chevron-down"></i></a>
                <ul class="slide-menu">
                    <li><a class="slide-item"
                           href="{{ route('orders.index') }}">{{__("names.manage")}} {{__("names.orders")}}</a></li>
                    <li><a class="slide-item" href="{{ route('orders.inventory') }}">{{__("names.inventory")}}</a></li>
                    <li><a class="slide-item" href="{{ route('orders.create') }}">{{__("names.add-order")}} <span
                                class="badge badge-danger side-badge">@lang('names.new')</span></a></li>
                </ul>
            </li>


            <li class="slide">
                <a class="side-menu__item" href="{{route('mybalance')}}">
                    <i class="bx bx-dollar side-menu__icon"></i>
                    <span  class="side-menu__label">{{__('names.mybalance')}}</span>
                </a>
            </li>

            <li class="slide">
                <a class="side-menu__item" href="{{route('help')}}">
                    <i class="bx  bx-help-circle  side-menu__icon"></i>
                    <span class="side-menu__label">{{__('names.help')}}</span>
                </a>
            </li>

            @can('feature','trash')
                <li class="slide">
                    <a class="side-menu__item" href="{{route('orders.trash')}}">
                        <i class="bx  bx-trash  side-menu__icon"></i>
                        <span class="side-menu__label">{{__('names.trash')}}</span>
                    </a>
                </li>
            @endcan
            <li class="slide">
                <a class="side-menu__item" href="{{route('setting')}}">
                    <i class="bx  bx-cog side-menu__icon"></i>
                    <span class="side-menu__label">{{__('names.setting')}}</span>
                </a>
            </li>

        </ul>
    </div>
</aside>
<!-- main-sidebar -->





