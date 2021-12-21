<aside class="main-sidebar sidebar-dark bg-gradient-navy text-white fixed elevation-4"
       @if(app()->getLocale() == "ar")
       dir="rtl"
       @else
       dir="ltr"
    @endif
>
    <a href="{{route('home')}}" class="brand-link text-center">
        <span class="brand-text font-weight-light ">
     {{ sys('company_name') ?? config('app.name', 'Laravel') }}
    </span>
    </a>
    <div class="sidebar ">
        <nav class="pt-2">
            <ul class="nav nav-pills nav-sidebar flex-column " data-widget="treeview" role="menu">
                <!-- Heading -->
                <div class=" text-muted">
                    Controls
                </div>
            @canany(['user-show','role-show'])
                <!-- Nav Item - Pages Collapse Menu -->
                    <li class="nav-item has-treeview ">
                        <a class="nav-link  text-white d-flex justify-content-between" href="">


                            <p>
                                <i class='bx bxs-user-detail bx-xs'></i>
                                @lang('names.users')


                            </p>
                            <span>
                                     <i class='bx bxs-left-arrow '></i>
                                </span>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('user-show')
                                <li class="nav-item">
                                    <a class="nav-link text-white " href="{{route('admin.users.index')}}">
                                        <p>
                                            @lang('names.users')
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('role-show')
                                <li class="nav-item">
                                    <a class="nav-link text-white " href="{{route('admin.roles.index')}}">
                                        <p>
                                            @lang('names.roles')
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('seller')
                                <li class="nav-item">
                                    <a class="nav-link  text-white" href="{{route('admin.sellers')}}">
                                        <p>
                                            @lang('names.sellers')
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
            @endcanany

            @can('area-show')
                <!-- Nav Item - Utilities Collapse Menu -->
                    <li class="nav-item has-treeview ">
                        <a class="nav-link text-white d-flex justify-content-between" href="">

                            <p>
                                <i class='bx bx-map-pin bx-xs'></i>
                                @lang('names.areas')

                            </p>
                            <span>
                                     <i class='bx bxs-left-arrow '></i>
                                </span>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('area-show')
                                <li class="nav-item">
                                    <a class="nav-link text-white " href="{{route('admin.areas.index')}}">
                                        <p>
                                            @lang('names.areas')
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('branch-show')
                                <li class="nav-item">
                                    <a class="nav-link text-white " href="{{route('admin.branches.index')}}">
                                        <p>
                                            @lang('names.branches')
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('zone-show')
                                <li class="nav-item">
                                    <a class="nav-link text-white " href="{{route('admin.zones.index')}}">
                                        <p>
                                            @lang('names.zones')
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
            @endcan
            <!-- Heading -->
                <div class="text-muted">
                    Interface
                </div>

            @can('task-show')
                <!-- Nav Item - Utilities Collapse Menu -->
                    <li class="nav-item has-treeview ">
                        <a class="nav-link text-white d-flex justify-content-between" href="">

                            <p>
                                <i class='bx bx-task bx-xs'></i>
                                @lang('names.tasks')

                            </p>
                            <span class=" ">
                                     <i class='bx bxs-left-arrow'></i>
                            </span>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('task-show')
                                <li class="nav-item">
                                    <a class="nav-link text-white " href="{{route('admin.tasks.index')}}">
                                        <p>
                                            @lang('names.tasks')
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('location-show')
                                <li class="nav-item">
                                    <a class="nav-link text-white " href="{{route('admin.locations.index')}}">
                                        <p>
                                            @lang('names.locations')
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
            @endcan


            @can('accounting')
                <!-- Nav Item - Utilities Collapse Menu -->
                    <li class="nav-item has-treeview ">
                        <a class="nav-link text-white d-flex justify-content-between" href="">
                            <p>
                                <i class='bx bx-dollar bx-xs'></i>
                                @lang('names.areas')

                            </p>
                            <span>
                                     <i class='bx bxs-left-arrow '></i>
                                </span>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('task-show')
                                <li class="nav-item">
                                    <a class="nav-link  text-white" href="{{route('admin.receipts.index')}}">
                                        <p>
                                            @lang('names.receipts')
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('financials')
                                <li class="nav-item">
                                    <a class="nav-link text-white " href="{{route('admin.financials')}}">
                                        <p>
                                            @lang('names.financials')
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('statics')
                                <li class="nav-item">
                                    <a class="nav-link text-white " href="{{route('admin.statics')}}">
                                        <p>
                                            @lang('names.statics')
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
            @endcan
            @can('order-show')
                <!-- Nav Item - Utilities Collapse Menu -->
                    <li class="nav-item has-treeview ">
                        <a class="nav-link text-white d-flex justify-content-between" href="">
                            <p class="">
                                <i class='bx bxs-cart-add bx-xs'></i>
                                @lang('names.areas')

                            </p>
                            <span>
                                     <i class='bx bxs-left-arrow '></i>
                                </span>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('order-show')
                                <li class="nav-item">
                                    <a class="nav-link text-white " href="{{route('admin.orders.index')}}">
                                        <p>
                                            @lang('names.orders')
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('packing')
                                <li class="nav-item">
                                    <a class="nav-link text-white " href="{{route('admin.packing')}}">
                                        <p>
                                            @lang('names.packing')
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan

                @can('plans')
                    <li class="nav-item">
                        <a class="nav-link text-white " href="{{route('admin.plans.index')}}">
                            <p>
                                <i class="fas fa-trash-restore-alt"></i>
                                @lang('names.plans')
                            </p>
                        </a>
                    </li>
                @endcan
                @can('help')
                    <li class="nav-item">
                        <a class="nav-link text-white " href="{{route('admin.help')}}">
                            <p>
                                <i class="fas fa-trash-restore-alt"></i>
                                @lang('names.help')
                            </p>
                        </a>
                    </li>
                @endcan
                @can('system')
                    <li class="nav-item">
                        <a class="nav-link text-white " href="{{route('admin.system')}}">
                            <p>
                                <i class="fas fa-trash-restore-alt"></i>
                                @lang('names.system')
                            </p>
                        </a>
                    </li>
                @endcan

                @can('trash')
                    <li class="nav-item">
                        <a class="nav-link text-white    " href="{{route('admin.trash')}}">
                            <p>
                                <i class="fas fa-trash-restore-alt"></i>
                                @lang('names.trash')
                            </p>
                        </a>
                    </li>
                @endcan


            </ul>
        </nav>
    </div>


</aside>
<!-- End of Sidebar -->

{{--    <div class="profile-inf">--}}
{{--        <img @if($path = auth()->user()->profile->profile_photo)--}}
{{--             src="{{ '/storage/' .$path}}"--}}
{{--             @else--}}
{{--             src="/pics/profile.png"--}}
{{--             @endif alt="profile picture"/>--}}
{{--        <div class="fb-info">--}}

{{--            <a href="{{route('admin.profile')}}" class="fb-username">{{ auth()->user()->name}}</a>--}}
{{--            <div class="fb-bio">{{ auth()->user()->profile->bio }}</div>--}}
{{--        </div>--}}


{{--        <a href="{{ route('logout') }}"--}}
{{--           onclick="event.preventDefault();--}}
{{--                                                     document.getElementById('logout-form').submit();">--}}
{{--            <i class="fas fa-sign-out-alt" id="logout"></i>--}}
{{--        </a>--}}
{{--        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">--}}
{{--            @csrf--}}
{{--        </form>--}}

{{--    </div>--}}


{{--<aside class="main-sidebar sidebar-dark-primary fixed elevation-4">--}}
{{--    <a href="{{route('home')}}" class="brand-link text-center">--}}
{{--        <span class="brand-text font-weight-light ">--}}
{{--        <b>Taco</b> system--}}
{{--    </span>--}}
{{--    </a>--}}
{{--    <div class="sidebar">--}}
{{--        <nav class="pt-2">--}}
{{--            <ul class="nav nav-pills nav-sidebar flex-column " data-widget="treeview" role="menu">--}}
{{--                <li class="nav-item">--}}
{{--                    <a class="nav-link  " href="{{route('home')}}">--}}
{{--                        <i class='bx bxs-dashboard bx-xs'></i>--}}
{{--                        <p>Dashboard</p>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                <li class="nav-header ">Interface</li>--}}
{{--                <li class="nav-item has-treeview">--}}
{{--                    <a class="nav-link  " href="">--}}
{{--                        <i class='bx bxs-user-detail bx-xs'></i>--}}
{{--                        <p>--}}
{{--                            Users--}}
{{--                            <i class='bx bxs-left-arrow right'></i>--}}
{{--                        </p>--}}
{{--                    </a>--}}
{{--                    <ul class="nav nav-treeview">--}}
{{--                        @can('user-show')--}}
{{--                            <li class="nav-item">--}}
{{--                                <a class="nav-link  " href="{{route('users.index')}}">--}}
{{--                                    <i class=" "></i>--}}
{{--                                    <p>--}}
{{--                                        Manage Users--}}
{{--                                    </p>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                        @endcan--}}
{{--                        @can('role-show')--}}
{{--                            <li class="nav-item">--}}
{{--                                <a class="nav-link  " href="{{route('roles.index')}}">--}}
{{--                                    <i class=" "></i>--}}
{{--                                    <p>--}}
{{--                                        Manage Roles--}}
{{--                                    </p>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                        @endcan--}}
{{--                    </ul>--}}
{{--                </li>--}}

{{--                <li class="nav-item has-treeview ">--}}
{{--                    <a class="nav-link  " href="">--}}
{{--                        <i class="bx bx-atom bx-xs"></i>--}}
{{--                        <p>--}}
{{--                            Formulas--}}
{{--                            <i class='bx bxs-left-arrow right'></i>--}}
{{--                        </p>--}}
{{--                    </a>--}}
{{--                    <ul class="nav nav-treeview">--}}
{{--                        @can('formula-show')--}}
{{--                            <li class="nav-item">--}}
{{--                                <a class="nav-link  " href="{{route('formulas.index')}}">--}}
{{--                                    <p>--}}
{{--                                        Manage Formulas--}}
{{--                                    </p>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                        @endcan--}}
{{--                        @can('element-show')--}}

{{--                            <li class="nav-item">--}}
{{--                                <a class="nav-link  " href="{{route('elements.index')}}">--}}
{{--                                    <p>--}}
{{--                                        Manage Elements--}}
{{--                                    </p>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                        @endcan--}}
{{--                        @can('category-show')--}}
{{--                            <li class="nav-item">--}}
{{--                                <a class="nav-link  " href="{{route('categories.index')}}">--}}
{{--                                    <p>--}}
{{--                                        Manage Categories--}}
{{--                                    </p>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                        @endcan--}}
{{--                    </ul>--}}
{{--                </li>--}}
{{--                                <li class="nav-item has-treeview ">--}}
{{--                                    <a class="nav-link  " href="">--}}
{{--                                        <i class='bx bx-network-chart bx-xs'></i>--}}
{{--                                        <p>--}}
{{--                                            Production--}}
{{--                                            <i class='bx bxs-left-arrow right' ></i>--}}
{{--                                        </p>--}}
{{--                                    </a>--}}
{{--                                    <ul class="nav nav-treeview" >--}}
{{--                                        <li class="nav-item">--}}
{{--                                            <a class="nav-link  " href="{{route('production')}}">--}}
{{--                                                <p>--}}
{{--                                                    Manage Production--}}
{{--                                                </p>--}}
{{--                                            </a>--}}
{{--                                        </li>--}}
{{--                                        <li class="nav-item">--}}
{{--                                            <a class="nav-link  " href="{{route('404')}}">--}}
{{--                                                <p>--}}
{{--                                                    Manage Products--}}
{{--                                                </p>--}}
{{--                                            </a>--}}
{{--                                        </li>--}}
{{--                                        <li class="nav-item">--}}
{{--                                            <a class="nav-link  " href="{{route('404')}}">--}}
{{--                                                <p>--}}
{{--                                                    Manage Projects--}}
{{--                                                </p>--}}
{{--                                            </a>--}}
{{--                                        </li>--}}
{{--                                    </ul>--}}
{{--                                </li>--}}
{{--                <li class="nav-item">--}}
{{--                    <a class="nav-link  " href="{{route('purchasing')}}">--}}
{{--                        <i class='bx bx-purchase-tag bx-xs '></i>--}}
{{--                        <p>--}}
{{--                            Purchasing--}}
{{--                        </p>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                <li class="nav-item">--}}
{{--                    <a class="nav-link  " href="{{route('production')}}">--}}
{{--                        <i class='bx bxs-network-chart bx-xs'></i>--}}
{{--                        <p>--}}
{{--                            Production--}}
{{--                        </p>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                @can('inventory')--}}
{{--                    <li class="nav-item">--}}
{{--                        <a class="nav-link  " href="{{route('inventory')}}">--}}
{{--                            <i class='bx bx-box bx-xs '></i>--}}
{{--                            <p>--}}
{{--                                Inventory--}}
{{--                            </p>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                @endcan--}}
{{--                                @can('accounting')--}}
{{--                                <li class="nav-item">--}}
{{--                                    <a class="nav-link  " href="{{route('accounting')}}">--}}
{{--                                        <i class='bx bx-line-chart bx-xs' ></i>--}}
{{--                                        <p>--}}
{{--                                            Accounting--}}
{{--                                        </p>--}}
{{--                                    </a>--}}
{{--                                </li>--}}
{{--                                @endcan--}}

{{--                                <li class="nav-item">--}}
{{--                                    <a class="nav-link  " href="{{route('dropbox')}}">--}}
{{--                                        <p>--}}
{{--                                            <i class='bx bxl-dropbox bx-xs' ></i>--}}
{{--                                            Dropbox--}}
{{--                                        </p>--}}
{{--                                    </a>--}}
{{--                                </li>--}}
{{--                @can('setting')--}}
{{--                    <li class="nav-item">--}}
{{--                        <a class="nav-link  " href="{{route('setting')}}">--}}
{{--                            <p>--}}
{{--                                <i class='bx bx-cog bx-xs'></i>--}}
{{--                                Setting--}}
{{--                            </p>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                @endcan--}}

{{--            </ul>--}}
{{--        </nav>--}}
{{--    </div>--}}

{{--</aside>--}}
