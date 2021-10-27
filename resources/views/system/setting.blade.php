@extends('admin.layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h1 class="text-center">Setting</h1>

                <p>{{ __('messages.setting') }}</p>
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <form action="{{route('admin.system')}}" method="Post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="auto_send" value="0">

                    <div class="form-group">
                        <label for="company_name" class="label">@lang('auth.company_name')</label>
                        <input type="text" name="company_name" class="form-control" value="{{$system->company_name ?? '' }}">
                        @error('company_name')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>


                    <div class="form-group row">
                        <div class="col-md-4">
                            <label for="company_logo" class="label">@lang('auth.company_logo')</label>
                            <input type="file" name="company_logo" id="company_logo"  class="form-control  @error('company_logo') is-invalid @enderror" value="{{$system->company_logo ?? '' }}">
                            @error('company_logo')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <div class="col-md-8 mb-2">
                            <img id="preview-image-before-upload"  src="https://www.riobeauty.co.uk/images/product_image_not_found.gif"
                                 alt="preview image" style="max-height: 250px;">
                        </div>
                    </div>
{{--                    <div class="form-group">--}}
{{--                        <label for="location_id" class="label">@lang('auth.location_id')</label>--}}
{{--                        <input type="number" name="location_id" class="form-control" value="{{$setting->location_id ?? '' }}">--}}
{{--                        @error('location_id')--}}
{{--                        <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                        @enderror--}}
{{--                    </div>--}}




                    <div class="form-group">
                        <label for="owner" class="label">@lang('auth.owner')</label>
                        <input type="text" name="owner" class="form-control" value="{{$system->owner ?? ''}}">
                        @error('owner')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email" class="label">@lang('auth.email')</label>
                        <input type="email" name="email" class="form-control" value="{{$system->email?? '' }}">
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="contact" class="label">@lang('auth.contact')</label>
                        <input type="tel" name="contact" class="form-control" value="{{$system->contact?? '' }}">
                        @error('contact')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="slogan" class="label">@lang('auth.slogan')</label>
                        <input type="text" name="slogan" class="form-control" value="{{$system->slogan ?? ''}}">
                        @error('slogan')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>


                    <div class="form-group">
                        <label for="theme" class="label">@lang('auth.theme')</label>
                        <input type="text" name="theme" class="form-control" value="{{$system->theme ?? '' }}">
                        @error('theme')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="footer" class="label">@lang('auth.footer')</label>
                        <input type="text" name="footer" class="form-control" value="{{$system->footer ?? ''}}">
                        @error('footer')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>


                    <div class="form-group">
                        <label for="theme" class="label">@lang('auth.reschedule_limit')</label>
                        <input type="number" name="reschedule_limit" class="form-control" value="{{$system->reschedule_limit ?? '' }}">
                        @error('theme')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="package_weight_limit" class="label">@lang('auth.package_weight_limit')</label>
                        <input type="number" name="package_weight_limit" class="form-control" value="{{$system->package_weight_limit ?? '' }}">
                        @error('package_weight_limit')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="auto_send" class="label">@lang('auth.auto_send')</label>
                        <input type="checkbox" name="auto_send" value="1" @if($system->auto_send ?? '' ) checked @endif>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-success">
                                {{ __('Save') }}
                            </button>
                        </div>
                    </div>
                </form>
{{--                @can('task-show')--}}
{{--                    <div class="card text-white bg-primary m-3 col-md-4"  style="max-width: 18rem;">--}}
{{--                        <div class="card-header">{{__("names.deleted")}} {{__("names.count")}} {{__("names.Tasks")}} </div>--}}
{{--                        <div class="card-body">--}}
{{--                            <h5 class="card-title"><a href="{{route('orders.trash')}}">{{$deletedOrders}} {{__("names.Orders")}}</a></h5>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                @endcan--}}

            </div>
        </div>
    </div>


@endsection

@section('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <script type="text/javascript">

        $(document).ready(function (e) {


            $('#company_logo').change(function(){

                let reader = new FileReader();

                reader.onload = (e) => {

                    $('#preview-image-before-upload').attr('src', e.target.result);
                }

                reader.readAsDataURL(this.files[0]);

            });

        });

    </script>
@endsection
