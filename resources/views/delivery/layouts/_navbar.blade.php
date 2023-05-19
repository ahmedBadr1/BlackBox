<!-- main-header opened -->
<div class="main-header sticky side-header nav nav-item">
    <div class="container-fluid">
        <div class="main-header-left ">
            <div class="responsive-logo">
                {{--                <a href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('assets/img/brand/logo.png')}}"--}}
                {{--                                                              class="logo-1" alt="logo"></a>--}}
                {{--                <a href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('assets/img/brand/logo-white.png')}}"--}}
                {{--                                                              class="dark-logo-1" alt="logo"></a>--}}
                {{--                <a href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('assets/img/brand/favicon.png')}}"--}}
                {{--                                                              class="logo-2" alt="logo"></a>--}}
                {{--                <a href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('assets/img/brand/favicon.png')}}"--}}
                {{--                                                              class="dark-logo-2" alt="logo"></a>--}}
            </div>
            <div class="app-sidebar__toggle" data-toggle="sidebar">

                <a class="open-toggle" href="#">      @if(app()->getLocale() == 'ar')
                        <i class='bx bx-align-right header-icon'></i>
                    @else
                        <i class='bx bx-align-left header-icon'></i>
                    @endif</a>
                <a class="close-toggle" href="#"><i class='bx bx-x header-icon' ></i></a>
            </div>
            <div class="main-header-center mr-3 d-sm-none d-md-none d-lg-block">
                <input class="form-control" placeholder="@lang('auth.search')" type="search">
                <button class="btn"><i class="fas fa-search d-none d-md-block"></i></button>
            </div>
        </div>
        <div class="main-header-right">
            <div class="nav nav-link"  >
                <ul class="d-flex">

                    <div class="dropdown nav-itemd-none d-md-flex">
                        <a href="#" class="d-flex  nav-item nav-link pl-0 country-flag" data-toggle="dropdown"
                           aria-expanded="false">
                            <i class="bx bx-flag bx-sm "></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-left dropdown-menu-arrow" x-placement="bottom-end">

                            {{-- @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)

                                <a class="dropdown-item d-flex " rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                <span class="avatar  ml-3 align-self-center bg-transparent"><img
                                        src="{{URL::asset('assets/img/flags/'.$localeCode.'.jpg')}}" alt="img"></span>
                                    <div class="d-flex">
                                        <span class="mr-2 ml-2 my-auto">{{ $properties['native'] }}</span>
                                    </div>
                                </a>

                            @endforeach --}}

                        </div>
                    </div>
                </ul>
            </div>
            <div class="nav nav-item"  >
                <div class="nav-link" onclick="theme()" >
                    @if(session()->get('theme') === 'dark')
                        <i class='bx bxs-brightness-half main-nav-dark bx-sm side-menu__icon' ></i>
                    @else
                        <i class='bx bx-brightness-half main-nav-dark bx-sm side-menu__icon' ></i>
                    @endif



                </div>
            </div>
            <div class="nav nav-item  navbar-nav-right ml-auto">
                <div class="nav-link" id="bs-example-navbar-collapse-1">
                    <form class="navbar-form" role="search">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="@lang('auth.search')">
                            <span class="input-group-btn">
											<button type="reset" class="btn btn-default">
												<i class="fas fa-times "></i>
											</button>
											<button type="submit" class="btn btn-default nav-link resp-btn">
												<svg xmlns="http://www.w3.org/2000/svg" class="header-icon-svgs"
                                                     viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                     stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                     class="feather feather-search"><circle cx="11" cy="11"
                                                                                            r="8"></circle><line x1="21"
                                                                                                                 y1="21"
                                                                                                                 x2="16.65"
                                                                                                                 y2="16.65"></line></svg>
											</button>
										</span>
                        </div>
                    </form>
                </div>


                {{--                <div class="dropdown nav-item main-header-message ">--}}
                {{--                    <a class="new nav-link" href="#">--}}
                {{--                        <i class='bx bx-envelope bx-sm side-menu__icon' ></i>--}}
                {{--                        <span class=" pulse-danger"></span></a>--}}
                {{--                    <div class="dropdown-menu">--}}
                {{--                        <div class="menu-header-content bg-primary text-right">--}}
                {{--                            <div class="d-flex justify-content-between">--}}
                {{--                                <h6 class="dropdown-title mb-1 tx-15 text-white font-weight-semibold">@lang('names.messages')</h6>--}}
                {{--                                <span--}}
                {{--                                    class="badge badge-pill badge-warning ">@lang('names.mark-all-read')</span>--}}
                {{--                            </div>--}}
                {{--                            <p class="dropdown-title-text subtext mb-0 text-white op-6 pb-0 tx-12 ">@lang('messages.no-unread-messages')</p>--}}
                {{--                        </div>--}}
                {{--                        <div class="main-message-list chat-scroll">--}}
                {{--                            @foreach(auth()->user()->notifications as $notification)--}}
                {{--                            <a href="#" class="p-3 d-flex border-bottom">--}}
                {{--                                <div class="  drop-img  cover-image  "--}}
                {{--                                     data-image-src="{{URL::asset('assets/img/faces/3.jpg')}}">--}}
                {{--                                    <span class="avatar-status bg-teal"></span>--}}
                {{--                                </div>--}}
                {{--                                <div class="wd-90p">--}}
                {{--                                    <div class="d-flex">--}}
                {{--                                        <h5 class="mb-1 name">Petey Cruiser</h5>--}}
                {{--                                    </div>--}}
                {{--                                    <p class="mb-0 desc">I'm sorry but i'm not sure how to help you with that......</p>--}}
                {{--                                    <p class="time mb-0 text-left float-right mr-2 mt-2">Mar 15 3:55 PM</p>--}}
                {{--                                </div>--}}
                {{--                            </a>--}}
                {{--                            @endforeach--}}
                {{--                        </div>--}}
                {{--                        <div class="text-center dropdown-footer">--}}
                {{--                            <a href="{{route('messages')}}">@lang('names.view-all')</a>--}}
                {{--                        </div>--}}
                {{--                    </div>--}}
                {{--                </div>--}}
                <div class="dropdown nav-item main-header-notification">
                    <a class="new nav-link" href="#">
                        <i class='bx bx-bell bx-sm side-menu__icon bx-tada-hover' ></i>
                        <span class=" pulse"></span></a>
                    <div class="dropdown-menu">
                        <div class="menu-header-content bg-primary text-right">
                            <div class="d-flex justify-content-between">
                                <h6 class="dropdown-title mb-1 tx-15 text-white font-weight-semibold">@lang('names.notifications')</h6>
                                <span class="badge badge-pill badge-warning ">@lang('names.mark-all-read')</span>
                            </div>
                            <p class="dropdown-title-text subtext mb-0 mt-1 ml-3 text-white op-6 pb-0 tx-12 ">@lang('messages.no-unread-notifications')</p>
                        </div>
                        <div class="main-notification-list Notification-scroll chat-scroll">
                            @foreach(auth()->user()->unreadNotifications as $k => $notification)

                                <a class="d-flex py-3 px-1 border-bottom" href="{{$notification->data['url']}}">
                                    {{--                                <div class="notifyimg bg-pink">--}}
                                    {{--                                    <i class="la la-file-alt text-white"></i>--}}
                                    {{--                                </div>--}}
                                    <div class="mx-3">
                                        <h5 class="notification-label mb-1">{{$notification->data['from']}}</h5>
                                        <div class="notification-subtext">{{\Illuminate\Support\Str::limit($notification->data['message'], 25)}}</div>

                                    </div>
                                    <div class="mr-auto">
                                        <i class='bx bx-time-five bx-xs'></i>
                                        <small class="tx-10">{{$notification->created_at->diffForHumans()}}</small>
                                    </div>
                                </a>
                                @php if ($k == 5) {
                                        break;
                                    }
                                @endphp
                            @endforeach
                        </div>
                        <div class="dropdown-footer">
                            <a href="{{route('delivery.notifications')}}">@lang('names.view-all')</a>
                        </div>
                    </div>
                </div>
                <div class="nav-item full-screen fullscreen-button">
                    <a class="new nav-link full-screen-link" href="#">
                        <i class='bx bx-fullscreen bx-sm bx-flashing-hover'></i>
                    </a>
                </div>
                <div class="dropdown main-profile-menu nav nav-item nav-link">
                    <a class="profile-user d-flex" href=""><img alt="profile photo" src="{{asset(auth()->user()->profile->photo ??'pics/profile.png')}}"></a>
                    <div class="dropdown-menu">
                        <div class="main-header-profile bg-primary p-3 ">
                            <div class="d-flex wd-100p">
                                <div class="main-img-user"><img alt="profile photo"   @if($path = auth()->user()->profile->photo)
                                    src="{{ '/storage/' .$path}}"
                                                                @else
                                                                src="/pics/profile.png"
                                                                @endif
                                                                class=""></div>
                                <div class="mx-3 my-auto">
                                    <h6>{{auth()->user()->name}}</h6><span>{{auth()->user()->profile->bio}}</span>
                                </div>
                            </div>
                        </div>
                        <a class="dropdown-item" href="{{route('delivery.profile')}}"><i
                                class="bx bx-user-circle"></i>@lang('names.profile')</a>
{{--                        <a class="dropdown-item" href="{{route('delivery.messages')}}"><i class="bx bxs-envelope"></i> @lang('names.messages')</a>--}}
{{--                        <a class="dropdown-item" href="{{route('delivery.setting')}}"><i class="bx bx-slider-alt"></i>@lang('names.setting')</a>--}}

                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                            <i class="bx bx-log-out"></i>@lang('auth.signout')
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </div>

                {{--                <div class="dropdown main-header-message right-toggle">--}}
                {{--                    <a class="nav-link pr-0" data-toggle="sidebar-left" data-target=".sidebar-left">--}}
                {{--                  <i class="bx bx-menu bx-sm side-menu__icon"></i>--}}
                {{--                    </a>--}}
                {{--                </div>--}}

            </div>
        </div>
    </div>
</div>
<!-- /main-header -->
