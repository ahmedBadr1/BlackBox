@extends('admin.layouts.admin')

@section('content')
    <div class="container-fluid">
        <h1 class="text-center"> {{__("names.packing")}} </h1>
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <div class="row  justify-content-center">


                @foreach($packing as $pack)
                <div class="col-md-3 mb-3 ">


                <div class="card col-md-12 ">
                    <div class="card-header">{{$pack->type}}</div>
                    <div class="card-body">
                        <p>Price :<b> {{$pack->price}}</b></p>
                        <p>Size :<b> {{$pack->size}}</b></p>
                    </div>
                </div>
                </div>
                @endforeach





        </div>
    </div>
@endsection

