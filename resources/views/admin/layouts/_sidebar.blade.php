<!-- main-sidebar -->
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar sidebar-scroll sidebar-left" style="  overflow-y: scroll">
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
                    <a href="{{route('admin.profile')}}">
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

        @canany(['user-show','role-show'])
            <!-- Nav Item - Pages Collapse Menu -->
                <li class="slide  ">
                    <a class="side-menu__item" data-toggle="slide">
                            <i class='bx bxs-user-detail side-menu__icon'></i>
                        <span class="side-menu__label">   @lang('names.users')   </span>
                        <span>
                                <i class='bx bxs-left-arrow angle '></i>
                            </span>
                    </a>
                    <ul class="slide-menu">
                        @can('user-show')
                            <li><a class="slide-item " href="{{route('admin.users.index')}}">@lang('names.users')</a></li>
                        @endcan
                        @can('role-show')
                            <li><a class="slide-item " href="{{route('admin.roles.index')}}">@lang('names.roles')</a></li>
                        @endcan
                        @can('sellers')
                            <li><a class="slide-item " href="{{route('admin.sellers')}}">@lang('names.sellers')</a></li>
                        @endcan
                    </ul>
                </li>
        @endcanany
        @can('area-show')
            <!-- Nav Item - Utilities Collapse Menu -->
                <li class="slide">
                    <a class="side-menu__item" data-toggle="slide"><i class='bx bx-map-pin  side-menu__icon'></i>
                        <span class="side-menu__label">   @lang('names.areas') </span>
                        <span>
                                     <i class='bx bxs-left-arrow angle '></i>
                        </span>
                    </a>
                    <ul class="slide-menu">
                        @can('area-show')
                            <li><a class="slide-item " href="{{route('admin.areas.index')}}">@lang('names.areas')</a></li>
                        @endcan
                        @can('branch-show')
                            <li><a class="slide-item " href="{{route('admin.branches.index')}}">@lang('names.branches')</a></li>
                        @endcan
                        @can('zone-show')
                            <li><a class="slide-item " href="{{route('admin.zones.index')}}">@lang('names.zones')</a></li>
                        @endcan
                    </ul>
                </li>
        @endcan
        @can('task-show')
            <!-- Nav Item - Utilities Collapse Menu -->
                <li class="slide  ">
                    <a class="side-menu__item" data-toggle="slide"><i class='bx bx-task side-menu__icon'></i>
                        <span class="side-menu__label">    @lang('names.tasks')</span>
                        <span><i class='bx bxs-left-arrow angle '></i></span>
                    </a>
                    <ul class="slide-menu">
                        @can('task-show')
                            <li><a class="slide-item " href="{{route('admin.tasks.index')}}">@lang('names.tasks')</a></li>
                        @endcan
                        @can('location-show')
                            <li><a class="slide-item " href="{{route('admin.locations.index')}}">@lang('names.locations')</a></li>
                        @endcan
                    </ul>
                </li>
        @endcan

        @can('order-show')
            <!-- Nav Item - Utilities Collapse Menu -->
                <li class="slide  ">
                    <a class="side-menu__item" data-toggle="slide"><i class='bx bx-cart side-menu__icon'></i>
                        <span class="side-menu__label">   @lang('names.orders')  </span>
                        <span><i class='bx bxs-left-arrow angle'></i></span>
                    </a>
                    <ul class="slide-menu">
                        @can('task-show')
                            <li><a class="slide-item " href="{{route('admin.orders.index')}}">@lang('names.orders')</a></li>
                        @endcan
                        @can('packing')
                            <li><a class="slide-item " href="{{route('admin.packing')}}">@lang('names.packing')</a></li>
                        @endcan
                    </ul>
                </li>
            @endcan


        @can('accounting')
            <!-- Nav Item - Utilities Collapse Menu -->
                <li class="slide  ">
                    <a class="side-menu__item" data-toggle="slide"><i class='bx bx-task side-menu__icon'></i>
                        <span class="side-menu__label">    @lang('names.accounting')</span>
                        <span><i class='bx bxs-left-arrow angle'></i></span>

                    </a>
                    <ul class="slide-menu">
                        @can('accounts')
                            <li><a class="slide-item " href="{{route('admin.accounts.index')}}">@lang('names.accounts')</a></li>
                        @endcan
                        @can('transactions')
                            <li><a class="slide-item " href="{{route('admin.transactions.index')}}">@lang('names.transactions')</a></li>
                        @endcan
                        @can('reports')
                            <li><a class="slide-item " href="{{route('admin.reports.index')}}">@lang('names.reports')</a></li>
                        @endcan
                    </ul>
                </li>
            @endcan

            @can('plans')
                <li class="slide">
                    <a class="side-menu__item" href="{{route('admin.plans.index')}}">
                        <i class="bx bx-purchase-tag side-menu__icon"></i>
                        <span class="side-menu__label">@lang("names.plans")</span>
                    </a>
                </li>
            @endcan
            @can('help')
                <li class="slide">
                    <a class="side-menu__item" href="{{route('admin.help')}}">
                        <i class="bx bx-help-circle side-menu__icon"></i>
                        <span class="side-menu__label">@lang("names.help")</span>
                    </a>
                </li>
            @endcan
            @can('system')
                <li class="slide">
                    <a class="side-menu__item" href="{{route('admin.system.index')}}">
                        <i class="bx bx-slider-alt bx-sm side-menu__icon"></i>
                        <span class="side-menu__label">@lang("names.system")</span>
                    </a>
                </li>
            @endcan
            @can('trash')
                <li class="slide">
                    <a class="side-menu__item" href="{{route('admin.trash')}}">
                        <i class="bx bx-trash bx-sm side-menu__icon"></i>
                        <span class="side-menu__label">@lang("names.trash")</span>
                    </a>
                </li>
            @endcan
{{--            <li class="slide">--}}
{{--                <a class="side-menu__item" href="{{route('admin.setting')}}">--}}
{{--                    <i class="bx bx-cog bx-sm side-menu__icon"></i>--}}
{{--                    <span class="side-menu__label">@lang("names.setting")</span>--}}
{{--                </a>--}}
{{--            </li>--}}


        </ul>
    </div>
</aside>



