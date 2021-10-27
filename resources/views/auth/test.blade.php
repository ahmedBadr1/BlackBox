@extends('valex.layouts.master2')
@section('css')
    <!-- Sidemenu-respoansive-tabs css -->
    <link href="{{URL::asset('assets/plugins/sidemenu-responsive-tabs/css/sidemenu-responsive-tabs.css')}}"
          rel="stylesheet">
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row no-gutter">
            <!-- The image half -->
            <div class="col-md-6 col-lg-6 col-xl-7 d-none d-md-flex bg-primary-transparent">
                <div class="row wd-100p mx-auto text-center">
                    <div class="col-md-12 col-lg-12 col-xl-12 my-auto mx-auto wd-100p">
                        <img src="{{URL::asset('assets/img/media/login.png')}}"
                             class="my-auto ht-xl-80p wd-md-100p wd-xl-80p mx-auto" alt="logo">
                    </div>
                </div>
            </div>
            <!-- The content half -->
            <div class="col-md-6 col-lg-6 col-xl-5 bg-white">
                <div class="login d-flex align-items-center py-2">
                    <!-- Demo content-->
                    <div class="container p-0">
                        <div class="row">
                            <div class="col-md-10 col-lg-10 col-xl-9 mx-auto">
                                <div class="card-sigin">
                                    <div class="mb-5 d-flex"><a href="{{ url('/' . $page='index') }}"><img
                                                src="{{URL::asset('assets/img/brand/favicon.png')}}"
                                                class="sign-favicon ht-40" alt="logo"></a>
                                        <h1 class="main-logo ml-1 mr-0 my-auto tx-28">{{sys('company_name') ?? config('app.name')}}</h1>
                                    </div>
                                    <div class="main-signup-header">
                                        <h2 class="text-primary">Get Started</h2>
                                        <h5 class="font-weight-normal mb-4">It's free to signup and only takes a
                                            minute.</h5>
                                        <form action="#">
                                            <div class="form-group">
                                                <label>Firstname &amp; Lastname</label> <input class="form-control"
                                                                                               placeholder="Enter your firstname and lastname"
                                                                                               type="text">
                                            </div>
                                            <div class="form-group row">


                                                <div class="col-md-12">
                                                    <label for="phone"
                                                           class=" col-form-label text-md-right">{{ __('auth.phone') }}</label>
                                                    <input id="phone" type="tel"
                                                           class="form-control @error('phone') is-invalid @enderror"
                                                           name="phone" value="{{ old('phone') }}"
                                                           placeholder="@lang('auth.enter-phone')" autocomplete="phone">
                                                    @error('phone')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-md-12">
                                                    <label for="email"
                                                           class=" col-form-label text-md-right">{{ __('auth.email') }}</label>
                                                    <input id="email" type="email"
                                                           class="form-control @error('email') is-invalid @enderror"
                                                           name="email" placeholder="@lang('auth.enter-email')"
                                                           value="{{ old('email') }}" required autocomplete="email">

                                                    @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                     </span>
                                                    @enderror
                                                </div>

                                            </div>
                                            <div class="form-group row">
                                                <div class="col-md-12">
                                                    <label for="password"
                                                           class="col-form-label text-md-right">{{ __('auth.pass') }}</label>
                                                    <input id="password" type="password"
                                                           class="form-control @error('password') is-invalid @enderror"
                                                           name="password" required
                                                           placeholder="@lang('auth.enter-password')">

                                                    @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                     </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <button
                                                class="btn btn-main-primary btn-block">@lang('auth.join-us')</button>
                                            <div class="row row-xs">
                                                <div class="col-sm-6">
                                                    <button class="btn btn-block"><i
                                                            class="fab fa-facebook-f"></i>@lang('auth.signup-facebook')
                                                    </button>
                                                </div>
                                                <div class="col-sm-6 mg-t-10 mg-sm-t-0">
                                                    <button class="btn btn-info btn-block"><i
                                                            class="bx bxl-twitter"></i>@lang('auth.signup-google')
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                        <div class="main-signup-footer mt-5">
                                            <p>@lang('auth.have-account?') <a
                                                    href="{{ route('login') }}">@lang('auth.signin')</a></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- End -->
                </div>
            </div><!-- End -->
        </div>
    </div>
@endsection
@section('js')
@endsection
