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

                <form action="{{route('admin.setting')}}" method="Post">
                    @csrf

                    <div class="form-group">
                        <label for="theme" class="label">@lang('auth.reschedule_limit')</label>
                        <input type="number" name="reschedule_limit" class="form-control" value="{{$setting->reschedule_limit ?? '' }}">
                        @error('theme')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="package_weight_limit" class="label">@lang('auth.package_weight_limit')</label>
                        <input type="number" name="package_weight_limit" class="form-control" value="{{$setting->package_weight_limit ?? '' }}">
                        @error('package_weight_limit')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>



                    <div class="form-group">
                        <label for="app_name" class="label">@lang('auth.app_name')</label>
                        <input type="text" name="app_name" class="form-control" value="{{$setting->app_name ?? ''}}">
                        @error('app_name')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="title" class="label">@lang('auth.title')</label>
                        <input type="text" name="title" class="form-control" value="{{$setting->title ?? ''}}">
                        @error('title')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="slogan" class="label">@lang('auth.slogan')</label>
                        <input type="text" name="slogan" class="form-control" value="{{$setting->slogan ?? ''}}">
                        @error('slogan')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="footer" class="label">@lang('auth.footer')</label>
                        <input type="text" name="footer" class="form-control" value="{{$setting->footer ?? ''}}">
                        @error('footer')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="owner" class="label">@lang('auth.owner')</label>
                        <input type="text" name="owner" class="form-control" value="{{$setting->owner ?? ''}}">
                        @error('owner')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email" class="label">@lang('auth.email')</label>
                        <input type="email" name="email" class="form-control" value="{{$setting->email?? '' }}">
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="theme" class="label">@lang('auth.theme')</label>
                        <input type="text" name="theme" class="form-control" value="{{$setting->theme ?? '' }}">
                        @error('theme')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="auto_send" class="label">@lang('auth.auto_send')</label>
                        <input type="checkbox" name="auto_send" @if($setting->auto_send ?? '' ) checked @endif>
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

