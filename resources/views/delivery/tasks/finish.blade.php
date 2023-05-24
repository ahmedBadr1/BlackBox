@extends('delivery.layouts.delivery')
@section('page-header')
    <h1 class="text-center">@lang('names.tasks') @lang("auth.finish") {{ $task->type }}for {{$user->name}}</h1>
    <a href="{{route('delivery.my-tasks')}}" class="btn btn-primary">@lang("names.manage-tasks")</a>
@endsection
@section('content')
    <form action="{{route('delivery.tasks.finish' , $task->id)}}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-8">
                @foreach($user->orders as $order)
                    <label for="orders[{{$order->id}}]">{{$order->hashid}} ({{$order->total}})</label>
                    <input type="checkbox" name="orders[{{$order->id}}]" value="{{$order->hashid}}">
                @endforeach
                @error('orders')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-success">
                        @lang('auth.finish')
                    </button>
                </div>
            </div>


        </div>
        </div>
    </form>
@endsection

