@extends('admin.layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <a href="{{route('admin.plans.index')}}">{{__("names.manage")}} {{__("names.plans")}}</a>
                <h1 class="text-center"> {{__("names.plan")}} {{$plan->name}}</h1>
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <label>{{__("names.plan")}} {{__("auth.orders_count")}}</label>
                <p><b>{{$plan->orders_count}}</b></p> <hr>
                <label>{{__("names.plan")}} {{__("auth.pickup_cost")}}</label>
                <p><b>{{$plan->pickup_cost}}</b></p> <hr>
                <label>{{__("names.plan")}} {{__("names.features")}}</label>
                <p>@foreach($plan->features as $feature)
                        <span class="badge badge-success"><a href="{{route('admin.features.show',$feature->id)}}">{{$feature->name}}</a></span>
                    @endforeach
                </p> <hr>



                <div class="d-flex ">
                    @can('role-edit')
                        <a href="{{ route('admin.plans.edit',$plan->id) }}" class="btn btn-info o">{{__("auth.edit")}}</a>
                    @endcan
                    @can('role-delete')
                        <form class="ml-5" action="{{route('admin.plans.destroy',$plan->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="submit" class="btn btn-danger" value="{{__("auth.delete")}}">
                        </form>
                    @endcan
                </div>


            </div>
        </div>
    </div>
@endsection

