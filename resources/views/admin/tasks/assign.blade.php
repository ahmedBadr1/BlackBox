@extends('admin.layouts.admin')
@section('page-header')
    <h1 class="text-center">@lang('names.tasks') @lang("names.assign") </h1>
    <div class="">
        <a href="{{route('admin.tasks.index')}}" class="btn btn-primary">@lang("names.manage-tasks")</a>
    </div>
@endsection
@section('content')

        <div class="row >
            <div class="col-md-12">

                <form action="{{route('admin.tasks.assign')}}" method="POST">
                    @csrf

                    <div class="form-group container-fluid col-md-12 mb-0">
                        <h3>Deliveries</h3>
                        <div class="row offset-md-2 ">
                            @foreach($deliveries as $delivery)
                                <div class="m-2">
                                    <input type="radio"  name="delivery"  value="{{$delivery->id}}">
                                    <label for="{{$delivery->name}}">{{$delivery->name}}</label><br>
                                </div>

                            @endforeach

                            @error('delivery')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>


                    <div class="form-group container-fluid col-md-12 mb-0">
                        <h3>@lang('names.ready-orders')</h3>
                        <div class="row offset-md-2 ">
                            @foreach($tasks as $task)
                                <div class="m-2">
                                    <input type="checkbox"  name="tasks[]" value="{{$task->id}}" @if($delivery->id === $task->delivery_id) @lang("checked")}} @endif>
                                    <label for="{{$task->id}}">{{$task->id}} => <a href="{{route('admin.tasks.show',$task->id)}}">{{$task->type}}</a> </label><br>
                                </div>
                            @endforeach

                            @error('orders')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>


                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-success">
                                @lang('names.assign') }}
                            </button>
                        </div>
                    </div>

                </form>

            </div>
        </div>

@endsection

