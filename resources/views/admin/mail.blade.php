@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <h1 class="text-center">Send Email</h1>
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
            </div>
            <div class="col-12">
                <form method="post" action="{{route('email.send')}}">
                    @csrf
                    @method('POST')
                    <div class="row">
                        <div class=" col-md-12">
                            <label for="heading" class="form-label">Email To</label>
                            @if($email !== '')
                                <select class="form-select" name="to" >
                                    <option value="{{$email}}" selected>{{$email}}</option>
                                </select>
                            @else
                                <select class="form-select" name="to" >
                                    <option value="" selected>select Email</option>
                                    @foreach($allMails as $mail)
                                        <option value="{{$mail}}">{{$mail}}</option>
                                    @endforeach
                                </select>
                            @endif


                            @error('to')
                            <small>{{ $message }}</small>
                            @enderror
                        </div></div>
                    <div class="row">
                        <div class=" col-md-6">
                            <label for="heading" class="form-label">Heading</label>
                            <input type="text" name="heading" class="form-control">
                            @error('heading')
                            <small>{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-6 form-floating">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" name="title" id="title" class="form-control">
                            @error('title')
                            <small>{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="">
                        <label for="floatingTextarea">Email Body</label>
                        <textarea name="body" class="form-control"  id="floatingTextarea"></textarea>
                        @error('body')
                        <small>{{ $message }}</small>
                        @enderror
                    </div><br>
                    <input type="submit" class="btn btn-success" value="Send">
                    {{--                   <button type="submit" class="btn btn-success">Send <i class="fas fa-paper-plane"></i></button>--}}
                </form>
            </div>
        </div>
    </div>
@endsection

