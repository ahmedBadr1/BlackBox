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
    <script src="{{ asset('js/app.js') }}" defer></script>
    @notifyCss
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <title>{{ config('app.name', 'Laravel') }}</title>
</head>
<body style="min-height:100vh;">
<div id="app" class="">


    @include('layouts._sidebar')
    <main class="fb-container">
        <ul>
            @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                <li>
                    <a rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                        {{ $properties['native'] }}
                    </a>
                </li>
            @endforeach
        </ul>
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>

        @endif

        @yield('content')
    </main>
</div>

</div>

<footer class=" fb-footer">
    <p >copyright &#169 Feedback 2021 <small>powered by Laravel v{{ Illuminate\Foundation\Application::VERSION }}</small></p>
</footer>
@include('partials._messages')
<script>
    let menu = document.getElementById('menu');
    let logout = document.getElementById('logout');
    let search = document.querySelector('.fa-search');
    let sideBar = document.querySelector('aside');
    let collapses = document.querySelectorAll('.sidebar-link');
    function toggle() {
        sideBar.classList.toggle('shrink');
        if(sideBar.classList.contains('shrink')){
            collapses.forEach(function (col) {
                col.ariaExpanded="false";
                // console.log(col.ariaExpanded);
            });
        }
    }

    menu.addEventListener('click', () => { toggle() });
    search.addEventListener('click', () => { toggle() });
    logout.addEventListener('click', () => { toggle() });
</script>
@yield('script')
<x:notify-messages />
@notifyJs
</body>
</html>
