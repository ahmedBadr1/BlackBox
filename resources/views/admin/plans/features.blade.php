@extends('admin.layouts.admin')
@section('page-header')
    <h1 class="text-center">@lang('names.all-features')</h1>
    @can('plan-show')
        <a href="{{route('admin.plans.index')}}" class="btn btn-primary">@lang('names.all-plans')</a>
    @endcan
    @can('plan-create')
        <a href="{{route('admin.plans.create')}}" class="btn btn-success">@lang('auth.create-plan')</a>
    @endcan

@endsection
@section('content')

        <div class="row">
            <div class="col-md-12">
                <table class="table table-hover">
                    <thead>
                    <th>@lang('auth.id')</th>
                    <th>@lang('auth.feature-name')</th>
                    <th>@lang('auth.rank')</th>
                    <th>@lang('auth.description')</th>
                    </thead>
                    <tbody>
                    @foreach($features as $feature)
                        <tr>
                            <td>{{$feature->id}} </td>
                            <td> <a href="{{ route('admin.features.show',$feature->id) }}"> {{$feature->name}} </a></td>

                            <td>{{$feature->rank}} </td>
                            <td>{{$feature->description}} </td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
@endsection

