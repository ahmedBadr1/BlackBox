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
@yield('meta')


<!-- Scripts -->


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <title>{{ config('app.name', 'Laravel') }}</title>
</head>
<body style="min-height:100vh;">
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
            <ul>
                {{-- @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                    <li>
                        <a rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                            {{ $properties['native'] }}
                        </a>
                    </li>
                @endforeach --}}
            </ul>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="@lang('Toggle navigation')">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item "><a href="/track" class="nav-link">@lang('names.track')</a></li>

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">@lang('auth.login') </a>
                            </li>
                        @endif

                        @if (Route::has('register'))

                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">@lang('auth.register') </a>
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

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    @lang('Logout')
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

    <main class="py-4 container-fluid">
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
        @yield('content')
    </main>

    <footer class="footer text-center">
        <p>powered by Laravel v{{ Illuminate\Foundation\Application::VERSION }}</p>
        <span class="text-muted">copyright &#169 Feedback 2021 All rights reserved</span>
    </footer>

</div>

@yield('script')
<script src="{{ asset('js/app.js') }}" defer></script>
</body>
</html>
