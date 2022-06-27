@extends('admin.layouts.admin')
@section('page-header')
    <h1 >@lang('auth.edit')  @lang('auth.task')</h1>
    <a href="{{route('admin.tasks.index')}}" class="btn btn-primary">@lang('names.manage-tasks')</a>
@endsection
@section('content')
        <div class="row ">
            <div class="col-md-12">
                <form method="POST" action="{{route('admin.tasks.update',$task->id)}}">
                    @csrf
                    @method('PUT')
                    <div class="form-group row">
                        <label for="role" class="col-md-4 col-form-label text-md-right">@lang('auth.type')</label>

                        <div class="col-md-6">
                            <select name="type" class="form-control"  >

                                @foreach($types as $type)
                                    <option value="{{$type}}" @if($type=== $task->type)
                                        @lang('selected')
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


                        <div class="col-md-6">
                            <label for="role" class=" col-form-label text-md-right">@lang('names.delivery')</label>
                            <select name="delivery_id" class="form-control" aria-label="Default select example" >

                                @foreach($deliveries as $delivery)
                                    <option value="{{$delivery->id}}"  @if($delivery->id=== $task->deliver_id)
                                        @lang('selected')
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
                            <label for="exampleFormControlTextarea1" class="form-label">@lang("names.notes")</label>
                            <textarea name="notes" class="form-control" rows="3">{{$task->notes}}</textarea>
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                @lang('auth.edit')
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
@endsection



