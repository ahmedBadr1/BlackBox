@extends('admin.layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h1 class="text-center">All Users</h1>
                @can('user-create')
                    <a href="{{route('admin.users.create')}}" class="btn btn-success">Create User</a>
                @endcan
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

              <livewire:admin.users-table />


            </div>
        </div>
    </div>


@endsection

