@extends('admin.layouts.admin')

@section('page-header')
    <h1 class="text-center">@lang('names.working-setting')</h1>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-8">

            <form action="{{route('admin.system.store')}}" method="Post" enctype="multipart/form-data">
                @csrf
                <div class="form-group row">
                    <div class="col-md-6">
                        <label for="reschedule_limit" class="label">@lang('auth.reschedule-limit')</label>
                        <input type="number" name="reschedule_limit" class="form-control" value="{{ sys('reschedule_limit') ?? '' }}">
                        @error('theme')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="package_weight_limit" class="label">@lang('auth.package-weight-limit')</label>
                        <input type="number" name="package_weight_limit" class="form-control" value="{{ sys('package_weight_limit') ?? '' }}">
                        @error('package_weight_limit')
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
            <div class="card">
                <div class="card-body">
                    <h4>@lang('auth.reschedule-limit')</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facere ipsa magnam pariatur totam. Ad dolore doloribus eum explicabo, itaque magni maxime minus nihil. Deleniti dolore doloremque eius magnam saepe similique. </p>
                    <hr>
                    <h4>@lang('auth.package-weight-limit')</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci atque culpa cumque explicabo facilis iste, libero molestias, mollitia quod reiciendis, sapiente sint tempore voluptas voluptatem voluptates. Excepturi illo necessitatibus quod.</p>
                </div>
            </div>
        </div>
    </div>
@endsection
