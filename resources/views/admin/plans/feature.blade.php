@extends('admin.layouts.admin')
@section('page-header')
    <h1 class="text-center"> @lang("names.feature") {{$feature->name}}</h1>
    <a href="{{route('admin.plans.index')}}" class="btn btn-primary ">@lang("names.manage-plans")}</a>
@endsection
@section('content')

        <div class="row justify-content-center">
            <div class="col-md-8">
                <label>@lang("auth.description")</label>
                <p><b>{{$feature->description}}</b></p> <hr>
                <label>} @lang("names.plans")</label>
                <p>@foreach($feature->plans as $plan)
                        <span class="badge badge-success"><a href="{{route('admin.plans.show',$plan->plan_id)}}">{{$plan->name}}</a></span>
                    @endforeach
                </p> <hr>

            </div>
        </div>
@endsection

