<!doctype html>
<html lang="{{ app()->getLocale()}}"
      @if(app()->getLocale() == "ar")
      dir="rtl"
    @endif
>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">



<!-- Scripts -->


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('meta')

    <title>{{ config('app.name', 'Laravel') }}</title>
</head>
<body id="page-top">
<!-- Navigation-->
<nav class="navbar navbar-expand-lg navbar-light   fixed-top" id="mainNav" style="background-color: #f0ffff47">
    <div class="container px-4 px-lg-5">
        <a class="navbar-brand" href="#page-top">{{ config('app.name', 'Black box') }}</a>

        <button class="navbar-toggler navbar-toggler-right" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars"></i>
        </button>
        @guest
            <p class="nav-item">
                <a class="nav-link" href="{{route('login')}}">Login</a>
            </p>
        @endguest
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('auth.login') }}</a>
                        </li>
                    @endif

                    @if (Route::has('register'))

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('auth.register') }}</a>
                        </li>
                    @endif
                @else
                    {{--                        <li class="nav-item">--}}
                    {{--                            <a class="nav-link" href="{{route('devices.all')}}">Devices</a>--}}
                    {{--                        </li>--}}

                    @can('dashboard')
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('dashboard')}}">Dashboard</a>
                        </li>
                    @endcan
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" style="    background-color: #f0ffff47;"  aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>


    @yield('content')


<footer class="footer text-center ">
    <div class="footer bg-black small text-center text-white-50 pt-3">
        <div class="container px-4 px-lg-5">  <p>powered by Laravel v{{ Illuminate\Foundation\Application::VERSION }}</p>
            <span class="text-muted">copyright &#169 Feedback 2021 All rights reserved</span>
        </div></div>
</footer>

@yield('script')
<script src="{{ asset('js/app.js') }}" defer></script>
</body>
</html>
