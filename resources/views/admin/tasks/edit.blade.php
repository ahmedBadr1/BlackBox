@extends('admin.layouts.admin')
@section('page-header')
    <h1 >@lang('auth.edit')  @lang('names.task')</h1>
    <a href="{{route('admin.tasks.index')}}" class="btn btn-primary">@lang('names.manage-tasks')</a>
@endsection
@section('content')
        <div class="row ">
            <div class="col-md-12">
                <form method="POST" action="{{route('admin.tasks.update',$task->id)}}">
                    @csrf
                    @method('PUT')
                    <div class="form-group row">
                        @if($mine)
                        <div class="col-md-6">
                            <label for="role" class="col-form-label text-md-right">@lang('auth.type')</label>
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
                        @else
                            <div class="col-md-6">
                                <label for="role" class="col-form-label text-md-right">@lang('auth.type')</label>
                                <p>{{$task->type}}</p>
                            </div>
                        @endif
                        <div class="col-md-6">
                            <label for="role" class=" col-form-label text-md-right">@lang('names.delivery')</label>
                            <select name="delivery_id" class="form-control" aria-label="Default select example" >
                                @foreach($deliveries as $delivery)
                                    <option value="{{$delivery->id}}"  @if($delivery->id=== $task->delivery_id) selected @endif>{{$delivery->name}}</option>
                                @endforeach
                            </select>
                            @error('delivery_id')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    @if($mine)
                    <div class="form-group row mb-0">
                        <div class="col-md-12">
                            <label for="exampleFormControlTextarea1" class="form-label">@lang("names.notes")</label>
                            <textarea name="notes" class="form-control" rows="3">{{$task->notes}}</textarea>
                        </div>
                    </div>
                    @else
                        <div class="col-md-6">
                            <label for="role" class="col-form-label text-md-right">@lang('auth.notes')</label>
                            <p>{{$task->notes}}</p>
                        </div>
                    @endif
                    <div class="form-group row mt-3">
                        <div class="col-md-12 text-right ">
                            <button type="submit" class="btn btn-primary ">
                                @lang('auth.edit')
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
@endsection



