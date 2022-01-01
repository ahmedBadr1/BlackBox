<!DOCTYPE html>
<html lang="{{ app()->getLocale()}}"
      @if(app()->getLocale() == "ar")
      dir="rtl"
    @endif
>
<head>
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="Description" content="">
    <meta name="Author" content="">
    <meta name="Keywords" content=""/>


    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    @include('valex.layouts.head')
    @livewireStyles
    @toastr_css

@yield('meta')
<!-- Fonts -->

    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    {{--    <link href="{{ asset('css/app.css') }}" rel="stylesheet">--}}
    <title>{{ sys('company_name') ?? config('app.name', 'Laravel') }}</title>
</head>

<body class="main-body app sidebar-mini @if(session()->get('theme') === 'dark') dark-theme  @endif">
<!-- Loader -->
<div id="global-loader">
    <img src="{{URL::asset('pics/loader.svg')}}" class="loader-img" alt="Loader">
</div>
<!-- /Loader -->
@include('admin.layouts._sidebar')
<!-- main-content -->
<div class="main-content app-content  " >
@include('admin.layouts._navbar')

<!-- container -->
    <div class="container-fluid ">
        <div class="hidden-print row d-flex justify-content-between ">
            @yield('page-header')
        </div>
        @yield('content')
        {{--        @include('valex.layouts.sidebar')--}}
    </div>
</div>
{{--@include('valex.layouts.sidebar')--}}
@include('valex.layouts.models')
@include('valex.layouts.footer')
@include('valex.layouts.footer-scripts')
<script >
    function theme() {
        let body = document.body;
        body.classList.toggle('dark-theme');
    }
</script>
</body>
</html>
