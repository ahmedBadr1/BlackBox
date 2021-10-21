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
    @include('valex.layouts.head')
    @livewireStyles
    @notifyCss
{{--    <script src="{{ asset('js/app.js') }}" defer></script>--}}

    <!-- Fonts -->

    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
{{--    <link href="{{ asset('css/app.css') }}" rel="stylesheet">--}}
    <title>{{ setting('company_name') ?? config('app.name', 'Laravel') }}</title>
</head>

<body class="main-body app sidebar-mini">
<!-- Loader -->
<div id="global-loader">
    <img src="{{URL::asset('assets/img/loader.svg')}}" class="loader-img" alt="Loader">
</div>
<!-- /Loader -->
@include('seller.layouts._sidebar')
<!-- main-content -->
<div class="main-content app-content">
@include('seller.layouts._navbar')

<!-- container -->
    <div class="container-fluid">
@yield('page-header')
@yield('content')
    </div>
{{--@include('valex.layouts.sidebar')--}}
@include('valex.layouts.models')
@include('valex.layouts.footer')
@include('valex.layouts.footer-scripts')

</body>
</html>
