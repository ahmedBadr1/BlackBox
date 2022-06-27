@extends('admin.layouts.admin')

@section('page-header')
    <h1 class="text-center">@lang('names.company-setting')</h1>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-8">

            <form action="{{route('admin.system.store')}}" method="Post" enctype="multipart/form-data">
                @csrf
                <div class="form-group row">
                    <div class="col-md-6">
                        <label for="company_name" class="label">@lang('auth.company-name')</label>
                        <input type="text" name="company_name" class="form-control" value="{{sys('company_name') ?? '' }}">
                        @error('company_name')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="owner" class="label">@lang('auth.owner')</label>
                        <input type="text" name="owner" class="form-control" value="{{sys('owner') ?? ''}}">
                        @error('owner')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="email" class="label">@lang('auth.email')</label>
                        <input type="email" name="email" class="form-control" value="{{sys('email')?? '' }}">
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="contact" class="label">@lang('auth.contact')</label>
                        <input type="text" name="contact" class="form-control" value="{{ sys('contact') }}">
                        @error('contact')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="company_logo" class="label">@lang('auth.company-logo')</label>
                        <input type="file" name="company_logo" id="company_logo"  class="form-control  @error('company_logo') is-invalid @enderror" >
                        @error('company_logo')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row mb-0">
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-success">
                            @lang('auth.save')
                        </button>
                    </div>
                </div>
            </form>

        </div>
        <div class="col-md-4">
            <img src="{{ asset('storage/'.sys('company_logo') ) }}" class="rounded-5 border-" width="200px" alt="logo">
        </div>
    </div>
@endsection
