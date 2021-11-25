<!doctype html>
<html lang="{{ app()->getLocale()}}"  @if(app()->getLocale() == "ar") dir="rtl"@endif >
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

@yield('meta')
    @stack('styles')

<!-- Scripts -->
    <script src="{{ asset('js/admin/admin.js') }}" defer></script>

    <!-- Fonts -->

    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/admin/admin.css') }}" rel="stylesheet">
    @livewireStyles
    @toastr_css
    <title>{{ sys('company_name') ?? config('app.name', 'Laravel') }}</title>
</head>
<body  class="sidebar-mini" style="height: auto;">

    <div class="wrapper">


        @include('admin.layouts._navbar')

        @include('admin.layouts._sidebar')


        <div class="content-wrapper " style="min-height: 404px;">


            <div class="content-header">
                <div class="container-fluid">
                    @yield('content_header')
                </div>
            </div>


            <div class="content">
                <div class="container-fluid">

                    @yield('content')
                </div>
            </div>
            <footer class=" fb-footer">
                <p > copyright &#169 Feedback 2021 <small> {{ sys('footer') ?? '' }}
                        {{--            powered by Laravel v{{ Illuminate\Foundation\Application::VERSION }}--}}
                    </small></p>
            </footer>
        </div>


        <div id="sidebar-overlay"></div>
    </div>


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

    @yield('js')
    <!-- Livewire Scripts -->

    @livewireScripts
    @jquery
    @toastr_js
    @toastr_render
    <script>
        window.livewire.on('alert', param => {
            toastr[param['type']](param['message']);
        });
    </script>
</body>
</html>
