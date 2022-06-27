@extends('admin.layouts.admin')
@section('page-header')
    <h1>@lang('names.all-plans')</h1>
    <div class="">
        <a href="{{route('admin.features')}}" class="btn btn-primary">@lang('names.all-features')</a>
        @can('plan-create')
            <a href="{{route('admin.plans.create')}}" class="btn btn-success">@lang('auth.create-plan')</a>
        @endcan
    </div>

@endsection
@section('content')

        <div class="row ">
            <div class="col-md-12">
                <table class="table table-hover table-responsive-md">

                    <thead>
                    <th>@lang('auth.id')</th>
                    <th>@lang('auth.plan-name')</th>
                    <th>@lang('names.orders-count')</th>
                    <th>@lang('auth.pickup-cost')</th>
                    <th>@lang('names.features')</th>
                    </thead>

                    <tbody>

                    @foreach($plans as $plan)

                        <tr>
                            <td>{{$plan->id}} </td>
                            <td> <a href="{{ route('admin.plans.show',$plan->id) }}"> {{$plan->name}} </a></td>

                            <td>{{$plan->orders_count}} </td>
                            <td>{{$plan->pickup_cost}} </td>

                            <td>
                                @forelse($plan->features as $feature)
                                   <span class="badge badge-success-transparent">
                                       <a href="{{route('admin.features.show',$feature->feature_id)}}">{{ $feature->name }}</a>
                                   </span>
                                @empty
                                    No Features
                                @endforelse
                                </td>
                            @can('plan-edit')
                                <td><a href="{{ route('admin.plans.edit',$plan->id) }}" class="btn btn-info">@lang('auth.edit')</a></td>
                            @endcan
                            @can('plan-delete')
                            <td>
                               <form action="{{route('admin.plans.destroy',$plan->id) }}" method="POST">
                                   @csrf
                                   @method('DELETE')
                                <input type="submit" class="btn btn-danger" name="delete" value="@lang('auth.delete')">
                               </form>
                            </td>
                            @endcan
                        </tr>
                    @endforeach

                    </tbody>

                </table>


            </div>
        </div>
    </div>


@endsection

