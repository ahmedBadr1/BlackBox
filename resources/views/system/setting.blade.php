@extends('admin.layouts.admin')
@section('page-header')

@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h1 class="text-center">@lang('auth.app-setting')</h1>

                <p class="text-center">@lang('messages.setting') </p>

                <form action="{{route('admin.system')}}" method="Post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="auto_send" value="0">

                    <div class="form-group row">
                        <div class="col-md-4">
                            <label for="company_name" class="label">@lang('auth.company-name')</label>
                            <input type="text" name="company_name" class="form-control" value="{{$system->company_name ?? '' }}">
                            @error('company_name')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="owner" class="label">@lang('auth.owner')</label>
                            <input type="text" name="owner" class="form-control" value="{{$system->owner ?? ''}}">
                            @error('owner')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="email" class="label">@lang('auth.email')</label>
                            <input type="email" name="email" class="form-control" value="{{$system->email?? '' }}">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="contact" class="label">@lang('auth.contact')</label>
                            <input type="tel" name="contact" class="form-control" value="{{$system->contact?? '' }}">
                            @error('contact')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="reschedule_limit" class="label">@lang('auth.reschedule-limit')</label>
                            <input type="number" name="reschedule_limit" class="form-control" value="{{$system->reschedule_limit ?? '' }}">
                            @error('theme')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="package_weight_limit" class="label">@lang('auth.package-weight-limit')</label>
                            <input type="number" name="package_weight_limit" class="form-control" value="{{$system->package_weight_limit ?? '' }}">
                            @error('package_weight_limit')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="slogan" class="label">@lang('auth.slogan')</label>
                            <input type="text" name="slogan" class="form-control" value="{{$system->slogan ?? ''}}">
                            @error('slogan')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="company_logo" class="label">@lang('auth.company-logo')</label>
                            <input type="file" name="company_logo" id="company_logo"  class="form-control  @error('company_logo') is-invalid @enderror" value="{{$system->company_logo ?? '' }}">
                            @error('company_logo')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="auto_send" class="label">@lang('auth.auto-send')</label>
                            <input type="checkbox" name="auto_send" value="1" @if($system->auto_send ?? '' ) checked @endif>
                        </div>

                    </div>


                    <div class="form-group row mb-0">
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-success">
                                @lang('Save')
                            </button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>


@endsection

@section('script')
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
