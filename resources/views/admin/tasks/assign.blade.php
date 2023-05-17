@extends('admin.layouts.admin')
@section('page-header')
    <h1 class="text-center">@lang('names.tasks') @lang("auth.assign") </h1>
    <div class="">
        <a href="{{route('admin.tasks.index')}}" class="btn btn-primary">@lang("names.manage-tasks")</a>
    </div>
@endsection
@section('content')
    <form action="{{route('admin.tasks.assign')}}" method="POST">
        @csrf
        <div class="row" >
            <div class="col-md-4">
                    <div class="form-group  ">
                                <select class="select2 input-group" name="delivery" >
                                    @foreach($deliveries as $delivery)
                                        <option value="{{$delivery->id}}">{{$delivery->name}}</option>
                                    @endforeach
                                </select>
                                @error('delivery')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                    </div>
        <div class="col-md-8">
            <select class="select2  input-group" multiple name="tasks[]" >
            @foreach($tasks as $task)
{{--                    <input type="checkbox"  name="tasks[]" value="{{$task->id}}" @if($delivery->id === $task->delivery_id) @lang("checked") @endif>--}}
                    <option value="{{$task->id}}">{{$task->type}}</option>
            @endforeach
            </select>
            @error('orders')
            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
            @enderror
        </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-success">
                                @lang('auth.assign')
                            </button>
                        </div>
                    </div>



            </div>
        </div>
    </form>
@endsection

