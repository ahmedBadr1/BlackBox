@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <h1 class="text-center">Dashboard</h1>
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                @can('user-show')
                    <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
                        <div class="card-header">Users Count</div>
                        <div class="card-body">
                            <h5 class="card-title">there is {{$users->count()}} Users</h5>

                        </div>
                    </div>
                @endcan
                @can('area-show')
                    <div class="card text-white bg-success mb-3" style="max-width: 18rem;">
                        <div class="card-header">Areas Count</div>
                        <div class="card-body">
                            <h5 class="card-title">there is {{$areas->count()}} Areas</h5>
                        </div>
                    </div>
                @endcan
{{--                @can('inbox')--}}
{{--                    <div class="card text-white bg-success mb-3" style="max-width: 18rem;">--}}
{{--                        <a href="" class="stretched-link">--}}
{{--                            <div class="card-header">Messages Count</div>--}}
{{--                            <div class="card-body">--}}
{{--                                <h5 class="card-title">there is {{$messages->count()}} Messages</h5>--}}
{{--                            </div>--}}
{{--                        </a>--}}
{{--                    </div>--}}
{{--                @endcan--}}
            </div>
        </div>
    </div>
@endsection

