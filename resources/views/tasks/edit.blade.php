@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">


                <a href="{{route('tasks.index')}}">Manage tasks</a>
                <h1 class="text-center">Edit Task {{$task->type}}</h1>
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <form method="POST" action="{{route('tasks.update',$task->id)}}">
                    @csrf
                    @method('PUT')
                    <div class="form-group row">
                        <label for="role" class="col-md-4 col-form-label text-md-right">Type</label>

                        <div class="col-md-6">
                            <select name="type" class="form-select" aria-label="Default select example" >

                                @foreach($types as $type)
                                    <option value="{{$type}}" @if($type=== $task->type)
                                        {{ __('selected') }}
                                        @endif>{{$type}}</option>
                                @endforeach
                            </select>
                            @error('type')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="role" class="col-md-4 col-form-label text-md-right">Delivery</label>

                        <div class="col-md-6">
                            <select name="delivery_id" class="form-select" aria-label="Default select example" >

                                @foreach($deliveries as $delivery)
                                    <option value="{{$delivery->id}}"  @if($delivery->id=== $task->deliver_id)
                                        {{ __('selected') }}
                                        @endif>{{$delivery->name}}</option>
                                @endforeach
                            </select>
                            @error('delivery_id')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <label for="exampleFormControlTextarea1" class="form-label">{{__("names.notes")}}</label>
                            <textarea name="notes" class="form-control" rows="3">{{$task->notes}}</textarea>
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                Edit
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection



