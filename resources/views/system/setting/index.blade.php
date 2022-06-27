@extends('admin.layouts.admin')

@section('page-header')
    <h1 class="text-center">@lang('auth.app-setting')</h1>
@endsection

@section('content')

    <div class="row">
{{--        <div class="col-lg-4 col-md-6">--}}
{{--            <a href="{{route('admin.system.default')}}" class=" card shadow">--}}
{{--                <div class="row  card-body">--}}
{{--                    <div class="col-auto">--}}
{{--                        <div class="badge bg-gradient-cyan settings-icons"><i class="bx bx-cog bx-lg"></i>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col ml--2"><h4 class="mb-0">@lang('names.default')</h4>--}}
{{--                        <p class="text-sm text-muted mb-0">Change app name, language, etc.</p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </a>--}}
{{--        </div>--}}
        <div class="col-lg-4 col-md-6">
            <a href="{{route('admin.system.company')}}" class="link-muted card shadow">
                <div class="row  card-body">
                    <div class="col-auto">
                        <div class="badge bg-gradient-cyan settings-icons">
                            <i class="bx bx-buildings bx-lg"></i>
                        </div>
                    </div>
                    <div class="col ml--2"><h4 class="mb-0">@lang('names.company')</h4>
                        <p class="text-sm text-muted mb-0">@lang('messages.company')</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-4 col-md-6 ">
            <a href="{{route('admin.system.working')}}" class="link-muted card shadow">
                <div class="row  card-body">
                    <div class="col-auto">
                        <div class="badge bg-gradient-cyan settings-icons">
                            <i class="bx bx-network-chart bx-lg"></i>
                        </div>
                    </div>
                    <div class="col ml--2"><h4 class="mb-0">@lang('names.working')</h4>
                        <p class="text-sm text-muted mb-0">@lang('messages.working')</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-4 col-md-6">
            <a href="{{route('admin.system.invoices')}}" class="link-muted card shadow">
                <div class="row  card-body" >
                    <div class="col-auto">
                        <div class="badge bg-gradient-cyan settings-icons"><i class="bx bx-receipt bx-lg"></i>
                        </div>
                    </div>
                    <div class="col ml--2 " style="text-decoration: none;"><h4 class="mb-0 ">@lang('names.invoices')</h4>
                        <p class="text-sm text-muted mb-0" style="text-decoration: none;">@lang('messages.invoices')</p>
                    </div>
                </div>
            </a>
        </div>
{{--        <div class="col-lg-4 col-md-6 ">--}}
{{--            <a href="{{route('admin.system.taxes')}}" class="link-muted card shadow">--}}
{{--                <div class="row  card-body">--}}
{{--                    <div class="col-auto">--}}
{{--                        <div class="badge bg-gradient-cyan settings-icons">--}}
{{--                            <i class='bx bx-money-withdraw bx-lg'></i>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col ml--2"><h4 class="mb-0">Taxes</h4>--}}
{{--                        <p class="text-sm text-muted mb-0">Change company name, email, address, tax number etc</p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </a>--}}
{{--        </div>--}}
    </div>


@endsection
