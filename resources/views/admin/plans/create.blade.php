@extends('admin.layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <a href="{{route('admin.plans.index')}}">{{__("names.manage")}} {{__("names.plans")}}</a>
                <h1 class="text-center">{{__("auth.create")}} {{__("names.plan")}}</h1>
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <form method="POST" action="{{ route('admin.plans.store') }}">
                    @csrf
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">{{__("names.plan")}} {{__("auth.name")}}</label>

                        <div class="col-md-6">
                            <input  type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('role') }}"  autocomplete="name" autofocus>

                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="orders_count" class="col-md-4 col-form-label text-md-right">{{__("names.plan")}} {{__("auth.orders_count")}}</label>

                        <div class="col-md-6">
                            <input  type="number" class="form-control @error('orders_count') is-invalid @enderror" name="orders_count" value="{{ old('orders_count') }}" >

                            @error('orders_count')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="pickup_cost" class="col-md-4 col-form-label text-md-right">{{__("names.plan")}} {{__("auth.pickup_cost")}}</label>

                        <div class="col-md-6">
                            <input  type="number" class="form-control @error('pickup_cost') is-invalid @enderror" name="pickup_cost" value="{{ old('pickup_cost') }}"  >

                            @error('pickup_cost')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            @foreach($features as $feature)
                                <input type="checkbox" id="{{$feature->name}}" name="features[]" value="{{$feature->id}}">
                                <label for="{{$feature->name}}">{{$feature->name}}</label><br>
                            @endforeach
                            @error('permissions')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>



                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-success">
                                {{ __('auth.create') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

