<!-- Favicon -->
<link rel="icon" href="{{URL::asset('favicon.ico')}}" type="image/x-icon"/>

<!--  Sidebar css -->
<link href="{{URL::asset('assets/plugins/sidebar/sidebar.css')}}" rel="stylesheet">
@yield('css')
@if(app()->getLocale() == "ar")
    <!-- Sidemenu css -->
    <link rel="stylesheet" href="{{URL::asset('assets/css-rtl/sidemenu.css')}}">



    <link rel="stylesheet" href="{{URL::asset('css/rtl.css')}}">

@else
    <!-- Sidemenu css -->
    <link rel="stylesheet" href="{{URL::asset('assets/css/sidemenu.css')}}">

    <link rel="stylesheet" href="{{URL::asset('css/ltr.css')}}">


@endif

