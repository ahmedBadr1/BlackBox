@extends('admin.layouts.admin')
@section('page-header')
    <h1 class="text-center">@lang('names.all-tasks')</h1>
    <div class="">
        @can('task-archive')
            <a href="{{route('admin.tasks.archive')}}" class="btn btn-dark">@lang('names.archive')</a>
        @endcan
        @can('task-create')
            <a href="{{route('admin.tasks.create')}}" class="btn btn-success">@lang('auth.create-task')</a>
        @endcan

    </div>
@endsection
@section('content')

   <livewire:admin.tasks-table />


@endsection

