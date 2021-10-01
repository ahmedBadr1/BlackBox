@extends('admin.layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <a href="{{route('admin.branches.index')}}">{{__("names.manage")}} {{__("names.branches")}}</a>
                <h1 class="text-center">{{$branch->name}} {{__("names.assing")}} </h1>
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <form action="{{route('admin.branches.assign',$branch->id)}}" method="POST">
                    @csrf

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            @foreach($users as $user)
                                    <input type="checkbox"  name="users[]" value="{{$user->id}}" @if($user->branch_id === $branch->id) {{__("checked")}} @endif>
                                    <label for="{{$user->name}}">{{$user->name}}</label><br>
                            @endforeach

                        @error('users')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                        </div>
                    </div>


                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-success">
                                {{ __('names.assign') }}
                            </button>
                        </div>
                    </div>

                </form>


            </div>
        </div>
    </div>
@endsection

