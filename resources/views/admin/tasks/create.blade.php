@extends('admin.layouts.admin')
@section('page-header')
    <h1 >@lang('auth.create-task')</h1>
  <div class="">
      <a href="{{ route('admin.tasks.index') }}" class="btn btn-primary">@lang('names.manage-tasks')</a>
  </div>
@endsection
@section('content')

        <div class="row ">
            <div class="col-md-12">

                <form method="POST" action="{{ route('admin.tasks.store') }}">
                    @csrf
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="role" class=" col-form-label text-md-right">@lang('auth.type')</label>
                            <select name="type" class="form-control" >
                                <option value="">@lang('auth.select-type')</option>
                                @foreach($types as $type)
                                    <option value="{{$type}}">{{$type}}</option>
                                @endforeach
                            </select>
                            @error('type')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="user_id" class="col-form-label text-md-right">@lang('names.seller')</label>

                            <select name="user_id" class="form-control select2"  >
                                <option value="">@lang('auth.select-seller')</option>
                                @foreach($sellers as $seller)
                                    <option value="{{$seller->id}}">{{$seller->name}}</option>
                                @endforeach
                            </select>
                            @error('user_id')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
{{--                    <hr>--}}
{{--                        //do it later--}}
{{--                    <hr>--}}
{{--                    <livewire:main.locations />--}}

                    <div class="form-group row">
                        <div class="col-md-4">
                            <label for="role" class="col-form-label text-md-right">@lang('auth.due-to')</label>
                            <input type="datetime-local" class="form-control" name="due_to">
                            @error('due_to')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="role" class=" col-form-label text-md-right">@lang('names.delivery')</label>
                            <select name="delivery_id" class="form-control select2" aria-label="Default select example" >
                                <option value="">@lang('auth.select-delivery')</option>
                                @foreach($deliveries as $delivery)
                                    <option value="{{$delivery->id}}">{{$delivery->name}}</option>
                                @endforeach
                            </select>
                            @error('delivery_id')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="col-md-4 ">
                            <label for="exampleFormControlTextarea1" class="form-label">@lang("auth.notes")</label>
                            <textarea name="notes" class="form-control" rows="3"></textarea>
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-success">
                                @lang('auth.create')
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

@endsection

