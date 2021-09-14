@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
              <h2 class="text-center">Welcome {{$user->name}}</h2>
            </div>
        </div>
    </div>


@endsection

