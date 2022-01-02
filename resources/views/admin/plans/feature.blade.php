@extends('admin.layouts.admin')
@section('page-header')
    <h1 class="text-center"> @lang("names.feature") : {{$feature->name}}</h1>
    <div class="">
        <a href="{{route('admin.plans.index')}}" class="btn btn-primary ">@lang("names.manage-plans")</a>
    </div>
@endsection
@section('content')

        <div class="row justify-content-center">
            <div class="col-md-8">
                <label>@lang("auth.description")</label>
                <p><b>{{$feature->description ?? __('messages.no-data')}}</b></p> <hr>
                <label>@lang("names.plans")</label>
                <p>@forelse($feature->plans as $plan)
                        <span class="badge badge-success"><a href="{{route('admin.plans.show',$plan->plan_id)}}">{{$plan->name}}</a></span>
                    @empty
                       <p>@lang('messages.no-feature-plan')</p>
                    @endforelse

                </p> <hr>

            </div>
        </div>
@endsection

