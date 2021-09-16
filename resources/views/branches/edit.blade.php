@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <a href="{{route('branches.index')}}">{{__("names.manage")}} {{__("auth.branches")}}</a>
                <h1 class="text-center">{{__("auth.edit")}} {{__("auth.branch")}}</h1>
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <form method="POST" action="{{ route('branches.update',$branch->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">{{__("auth.branch")}} {{__("auth.name")}}</label>
                        <div class="col-md-6">
                            <input  type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{$branch->name}}"  autofocus>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="phone" class="col-md-4 col-form-label text-md-right">{{__("names.branch")}} {{__("auth.phone")}}</label>
                        <div class="col-md-6">
                            <input  type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ $branch->phone }}" >
                            @error('phone')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="location" class="col-md-4 col-form-label text-md-right">{{__("names.branch")}} {{__("auth.location")}}</label>
                        <div class="col-md-6">
                            <input  type="text" class="form-control @error('location') is-invalid @enderror" name="location" value="{{ $branch->location }}"  >
                            @error('location')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>


                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <select name="manager" id="manager">
                            @foreach($managers as $manager)
                                <option value="{{$manager}}" @if($manager = $branch->manager) {{__('selected')}}@endif >{{$manager}}</option>
                            @endforeach
                            </select>
                            @error('manager')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>


                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-info">
                                {{ __('auth.edit') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

