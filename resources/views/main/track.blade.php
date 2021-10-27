@extends('main.layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1 class="text-center">{{__("names.track")}}</h1>
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <form action="{{route('track')}}" method="POST">
                    @csrf

                        <div class="form-group">
                            <label for="">Enter Order Track Id</label>
                            <input type="text" name="order_id" class="form-control" value="{{$order_hashid ?? ''}}">
                        </div>
                        @error('order_id')
                        <strong>{{$message}}</strong>
                    @enderror


                    <div class="form-group row mb-0 mt-3">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-success">
                                {{ __('names.track') }}
                            </button>
                        </div>
                    </div>

                </form>


        @if($status)

                    <div class="">{{__("message.".$status)}}</div>
        @endif
            </div>
        </div>
    </div>
@endsection

