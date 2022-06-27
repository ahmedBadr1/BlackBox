@extends('seller.layouts.seller')
@section('css')
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="main-content-title mb-0 my-auto">@lang('names.profile')</h4>
            </div>
        </div>
        <div class="d-flex my-xl-auto right-content">

        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row row-sm">
        <div class="col-lg-4">
            <div class="card mg-b-20">
                <div class="card-body">
                    <div class="pl-0">
                        <div class="main-profile-overview">
                            <div class="main-img-user profile-user">
                                <img alt="profile photo"
                                     @if($path = auth()->user()->profile->photo)
                                     src="{{ '/storage/' .$path}}"
                                     @else
                                     src="/pics/profile.png"
                                    @endif>
{{--                                <a class="bx bxs-camera profile-edit" href="JavaScript:void(0);"></a>--}}
                            </div>
                            <div class="d-flex justify-content-between mg-b-20">
                                <div>
                                    <h5 class="main-profile-name">{{$user->name}}</h5>
                                    <p class="main-profile-name-text">{{$user->profile->bio}}</p>
                                </div>
                            </div>
                            <div class="card-title">@lang('names.info')</div>
                            <div class="main-profile-bio">

                            </div><!-- main-profile-bio -->
                            <div class="row ">

                                <div class="col-md-12 col bg-info-transparent my-2">
                                    <h6 class="text-small text-muted mb-0">@lang('auth.email')</h6>
                                    <h5>{{$user->email}}</h5>
                                </div>

                                <div class="col-md-8 col my-2">
                                    <h6 class="text-small text-muted mb-0">@lang('auth.phone')</h6>
                                    <h5>{{$user->phone}}</h5>
                                </div>

                                @if($user->profile->address)
                                <div class="col-md-8 col my-2">
                                    <h6 class="text-small text-muted mb-0">@lang('auth.address')</h6>
                                    <h5>{{$user->profile->address}}</h5>
                                </div>
                                @endif
                                @if($user->profile->url)
                                <div class="col-md-8 col my-2">
                                    <h6 class="text-small text-muted mb-0">@lang('auth.company-name')</h6>
                                    <h5><a href="{{$user->profile->url}}">{{$user->profile->url}}</a></h5>
                                </div>
                                @endif


                            </div>
                            <hr class="mg-y-30">
                            <label class="main-content-label tx-13 mg-b-20">@lang('names.social')</label>
                            <div class="main-profile-social-list">
                                <div class="media">
                                    <div class="media-icon bg-primary-transparent text-primary">
                                        <i class="icon ion-logo-github"></i>
                                    </div>
                                    <div class="media-body">
                                        <span>Github</span> <a href="">github.com/feedback</a>
                                    </div>
                                </div>
                                <div class="media">
                                    <div class="media-icon bg-success-transparent text-success">
                                        <i class="icon ion-logo-twitter"></i>
                                    </div>
                                    <div class="media-body">
                                        <span>Twitter</span> <a href="">twitter.com/feedback.me</a>
                                    </div>
                                </div>
                                <div class="media">
                                    <div class="media-icon bg-info-transparent text-info">
                                        <i class="icon ion-logo-linkedin"></i>
                                    </div>
                                    <div class="media-body">
                                        <span>Linkedin</span> <a href="">linkedin.com/in/feedback</a>
                                    </div>
                                </div>

                            </div>
                            <hr class="mg-y-30">
                            <h6 class="card-title">@lang('names.progress')</h6>


                            <div class="skill-bar clearfix">
                                <span>@lang('names.orders')</span>
                                <div class="progress mt-2">
                                    <div class="progress-bar bg-info-gradient" role="progressbar" aria-valuenow="85"
                                         aria-valuemin="0" aria-valuemax="100" style="width: 95%"></div>
                                </div>
                            </div>
                            <!--skill bar-->
                        </div><!-- main-profile-overview -->
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="row row-sm">
                <div class="col-sm-12 col-xl-4 col-lg-12 col-md-12">
                    <div class="card ">
                        <div class="card-body">
                            <div class="counter-status d-flex md-mb-0">
                                <div class="counter-icon bg-primary-transparent">
                                    <i class="icon-layers text-primary"></i>
                                </div>
                                <div class="mr-auto">
                                    <h5 class="tx-13">@lang('names.orders')</h5>
                                    <h2 class="mb-0 tx-22 ml-2 mt-1">{{$count}}</h2>
                                    <p class="text-muted mb-0 tx-11"><i
                                            class="si si-arrow-up-circle text-success mr-1"></i>@lang('names.increase')</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-xl-4 col-lg-12 col-md-12">
                    <div class="card ">
                        <div class="card-body">
                            <div class="counter-status d-flex md-mb-0">
                                <div class="counter-icon bg-danger-transparent">
                                    <i class="icon-paypal text-danger"></i>
                                </div>
                                <div class="mr-auto">
                                    <h5 class="tx-13">@lang('names.revenue')</h5>
                                    <h2 class="mb-0 tx-22 ml-2 mt-1">{{$total}}</h2>
                                    <p class="text-muted mb-0 tx-11"><i
                                            class="si si-arrow-up-circle text-success mr-1"></i>@lang('names.increase')</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-xl-4 col-lg-12 col-md-12">
                    <div class="card ">
                        <div class="card-body">
                            <div class="counter-status d-flex md-mb-0">
                                <div class="counter-icon bg-success-transparent">
                                    <i class="icon-rocket text-success"></i>
                                </div>
                                <div class="mr-auto">
                                    <h5 class="tx-13">@lang('names.products')</h5>
                                    <h2 class="mb-0 tx-22 ml-2 mt-1">{{$products}}</h2>
                                    <p class="text-muted mb-0 tx-11"><i
                                            class="si si-arrow-up-circle text-success mr-1"></i>@lang('names.increase')</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="tabs-menu ">
                        <!-- Tabs -->
                        <ul class="nav nav-tabs profile navtab-custom panel-tabs">
                            <li class="active">
                                <a href="#home" data-toggle="tab" aria-expanded="true"> <span class="visible-xs"><i
                                            class="las la-user-circle tx-16 mr-1"></i></span> <span class="hidden-xs">@lang('names.about-me')</span>
                                </a>
                            </li>
                            <li class="">
                                <a href="#settings" data-toggle="tab" aria-expanded="false"> <span class="visible-xs"><i
                                            class="las la-cog tx-16 mr-1"></i></span> <span
                                        class="hidden-xs">@lang('names.setting')</span> </a>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-content border-left border-bottom border-right border-top-0 p-4">
                        <div class="tab-pane active" id="home">
                            <form method="POST" action="{{route('profile.update')}}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class=" row">
                                    <div class="col-md-4">
                                    <label for="name" class=" col-form-label text-md-right">@lang('auth.name') }}</label>
                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}"  autocomplete="name" autofocus>
                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-8">
                                    <label for="bio" class=" col-form-label text-md-right">@lang('auth.bio') }}</label>

                                        <input id="bio" type="text" class="form-control @error('bio') is-invalid @enderror" name="bio" value="{{ $user->profile->bio  }}"  >
                                        @error('bio')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>


                                <div class=" row">
                                    <div class="col-md-8">
                                    <label for="email" class=" col-form-label text-md-right">@lang('auth.email') }}</label>

                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}"  autocomplete="email">

                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                    <label for="phone" class=" col-form-label text-md-right">@lang('auth.phone') }}</label>

                                        <input id="phone" type="tel" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ $user->phone  }}"  autocomplete="phone">
                                        @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="address" class="col-form-label text-md-right">@lang('auth.address')}}</label>
                                        <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ $user->profile->address  }}"  >

                                        @error('address')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="area" class=" col-form-label text-md-right">@lang('names.area')}}</label>
                                        <select id="area" class="form-select form-control @error('area') is-invalid @enderror" name="area"  aria-label="Default select example" >
                                            @foreach($areas as $area)
                                                <option value="{{$area}}" @if($area === $user->profile->area)
                                                    @lang('selected') }}
                                                    @endif>{{$area}}</option>
                                            @endforeach
                                        </select>
                                        @error('area')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>



                                <div class="form-group row">
                                    <div class="col-md-8">
                                        <label for="url" class=" col-form-label text-md-right">@lang('auth.url')}}</label>
                                        <input id="url" type="url" class="form-control @error('url') is-invalid @enderror" name="url" value="{{ $user->profile->url  }}"  >

                                        @error('url')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>

                                    <div class="col-md-4">
                                        <label for="photo" class=" col-form-label text-md-right">@lang('auth.photo')}}</label>
                                        <input id="photo" type="file" class="form-control @error('photo') is-invalid @enderror" name="photo" >
                                        @error('photo')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>

                                </div>
                                <div class="row"> <div class="col-md-4 mb-2">
                                        <img id="preview-image-before-upload" src="https://www.riobeauty.co.uk/images/product_image_not_found.gif"
                                             alt="preview image" >
                                    </div></div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            @lang('auth.update')}}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane" id="settings">
                            <p>no setting yet</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
    <script type="text/javascript">

        $(document).ready(function (e) {


            $('#photo').change(function(){

                let reader = new FileReader();

                reader.onload = (e) => {

                    $('#preview-image-before-upload').attr('src', e.target.result);
                }

                reader.readAsDataURL(this.files[0]);

            });

        });

    </script>
@endsection
