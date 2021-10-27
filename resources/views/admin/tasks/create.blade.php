@extends('admin.layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <a href="{{route('admin.tasks.index')}}">@lang('auth.manage-tasks')</a>
                <h1 class="text-center">@lang('auth.create-new-task')</h1>
                <a href="{{ route('admin.tasks.index') }}" class="btn btn-outline-primary">@lang('names.all-tasks')</a>
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.tasks.store') }}">
                    @csrf


                    <div class="form-group row">
                        <label for="role" class="col-md-4 col-form-label text-md-right">Type</label>

                        <div class="col-md-6">
                            <select name="type" class="form-select" aria-label="Default select example" >
                                <option value="">@lang('names.select-type')</option>
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
                    </div>

                    <div class="form-group row">
                        <label for="user_id" class="col-md-4 col-form-label text-md-right">@lang('names.seller')</label>

                        <div class="col-md-6">
                            <select name="user_id" class="form-select"  >
                                <option value="">@lang('names.select-seller')</option>
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

                    <livewire:main.locations />

                    <div class="form-group row">
                        <label for="role" class="col-md-4 col-form-label text-md-right">due_to</label>

                        <div class="col-md-6">
                            <input type="datetime-local" name="due_to">
                            @error('due_to')
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
                                <option value="">Select a Delivery</option>
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
                    </div>


                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <label for="exampleFormControlTextarea1" class="form-label">{{__("names.notes")}}</label>
                            <textarea name="notes" class="form-control" rows="3"></textarea>
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-success">
                                {{ __('Create') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

