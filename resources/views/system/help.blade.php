@extends('system.layouts.system')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h1 class="text-center">Help</h1>
                <p>{{ __('messages.help') }}</p>
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif



            </div>
        </div>
    </div>


@endsection

