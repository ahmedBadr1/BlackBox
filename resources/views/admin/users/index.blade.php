@extends('admin.layouts.admin')
@section('page-header')
    <h1 class="text-center">@lang('names.all-users')</h1>
    <div class="">
        @can('user-create')
            <a href="{{route('admin.users.create')}}" class="btn btn-success">@lang('auth.create-user')</a>
        @endcan
    </div>

@endsection
@section('content')

        <div class="row justify-content-center">
            <div class="col-md-12">
              <livewire:admin.users-table />
            </div>
        </div>


@endsection

