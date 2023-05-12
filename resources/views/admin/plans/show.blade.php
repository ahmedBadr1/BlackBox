@extends('admin.layouts.admin')
@section('page-header')
    <h1> @lang("names.plan") {{$plan->name}}</h1>
    <a href="{{route('admin.plans.index')}}" class="btn  btn-primary">@lang("names.manage-plans")</a>

@endsection
@section('content')

        <div class="row ">
            <div class="col-md-8">

                <label> @lang("auth.orders_count")</label>
                <p><b>{{$plan->orders_count}}</b></p> <hr>
                <label> @lang("auth.pickup_cost")</label>
                <p><b>{{$plan->pickup_cost}}</b></p> <hr>
                <label> @lang("names.features")</label>
                <p>@foreach($plan->features as $feature)
                        <a href="{{route('admin.features.show',$feature->id)}}" class="badge badge-success">{{$feature->name}}</a>
                    @endforeach
                </p> <hr>



                <div class="d-flex ">
                    @can('role-edit')
                        <a href="{{ route('admin.plans.edit',$plan->id) }}" class="btn btn-info o">@lang("auth.edit")</a>
                    @endcan
                    @can('role-delete')
                        <form class="ml-5" action="{{route('admin.plans.destroy',$plan->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="submit" class="btn btn-danger" value="@lang("auth.delete")">
                        </form>
                    @endcan
                </div>


            </div>
        </div>

@endsection

