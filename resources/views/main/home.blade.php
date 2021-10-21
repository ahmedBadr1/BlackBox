@extends('main.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Welcome') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('welcome to our website') }}
{{--                    <h1>hello mohamed ayman</h1>--}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
