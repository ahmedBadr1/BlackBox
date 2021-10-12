<!doctype html>
<html lang="{{ app()->getLocale()}}"  @if(app()->getLocale() == "ar") dir="rtl"@endif >
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

@yield('meta')
    @stack('styles')
    @livewireStyles
<!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    @notifyCss
    <!-- Fonts -->

    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <title>{{ setting('title') ?? config('app.name', 'Laravel') }}</title>
</head>
<body >
<div id="app" class="">
    <nav class="navbar navbar-light bg-light ">
        <div class="container-fluid">
            <div class="nav-logo"></div>
            <ul class="d-flex">
                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                    <li>
                        <a rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                            {{ $properties['native'] }}
                        </a>
                    </li>
                @endforeach
            </ul>

            <i class="fas fa-bell"></i>
            <i class="fas fa-envelope "></i><span class="counter counter-lg">29</span>
        </div>
    </nav>

    @auth()
        @if ( auth()->user()->hasRole('seller'))
        @include('seller.layouts._sidebar')
        @elseif(auth()->user()->hasRole('delivery'))
                @include('delivery.layouts._sidebar')
        @else
            @include('admin.layouts._sidebar')
        @endif
    @else

    @endauth

    <main class="fb-container">


        <!-- As a heading -->



        @if (Session::has('success'))
            @php
                notify()->success(Session::get('success'));
            @endphp
        @endif

        @yield('content')
    </main>


</div>
<footer class=" fb-footer">
    <p > copyright &#169 Feedback 2021 <small> {{ setting('footer') ?? '' }}
{{--            powered by Laravel v{{ Illuminate\Foundation\Application::VERSION }}--}}
        </small></p>
</footer>
{{--<script>--}}
{{--    let menu = document.getElementById('menu');--}}
{{--    let search = document.querySelector('.fa-search');--}}
{{--    let sideBar = document.querySelector('aside');--}}
{{--    let collapses = document.querySelectorAll('.sidebar-link');--}}
{{--    function toggle() {--}}
{{--        sideBar.classList.toggle('shrink');--}}
{{--        if(sideBar.classList.contains('shrink')){--}}
{{--            collapses.forEach(function (col) {--}}
{{--                col.ariaExpanded="false";--}}
{{--                // console.log(col.ariaExpanded);--}}
{{--            });--}}
{{--        }--}}
{{--    }--}}

{{--    menu.addEventListener('click', () => { toggle() });--}}
{{--    search.addEventListener('click', () => { toggle() });--}}
{{--</script>--}}

<x:notify-messages />
@livewireScripts
@notifyJs
@yield('script')
</body>
</html>
