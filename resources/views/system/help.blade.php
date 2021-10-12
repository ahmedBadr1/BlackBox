@extends('admin.layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h1 class="text-center">{{ __('names.help-center') }}</h1>
                <p  class="text-center">{{ __('messages.help') }}</p>
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif



            </div>
        </div>
    </div>


@endsection
