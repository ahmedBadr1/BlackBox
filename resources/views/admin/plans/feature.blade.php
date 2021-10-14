@extends('admin.layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <a href="{{route('admin.plans.index')}}">{{__("names.manage")}} {{__("names.plans")}}</a>
                <h1 class="text-center"> {{__("names.feature")}} {{$feature->name}}</h1>
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <label>{{__("names.plan")}} {{__("auth.orders_count")}}</label>
                <p><b>{{$feature->rank}}</b></p> <hr>
                <label>{{__("names.plan")}} {{__("auth.description")}}</label>
                <p><b>{{$feature->description}}</b></p> <hr>
                <label>{{__("names.feature")}} {{__("names.plans")}}</label>
                <p>@foreach($feature->plans as $plan)
                        <span class="badge badge-success"><a href="{{route('admin.plans.show',$plan->plan_id)}}">{{$plan->name}}</a></span>
                    @endforeach
                </p> <hr>

            </div>
        </div>
    </div>
@endsection

