@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <a href="{{route('areas.index')}}">Manage Areas</a>
                <h1 class="text-center">Create Area</h1>
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
            <!-- Button trigger modal -->
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#zoneModal">{{__('auth.create')}} Zone</button>
                <form method="POST" action="{{ route('areas.store') }}">
                    @csrf
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">Area Name</label>

                        <div class="col-md-6">
                            <input  type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}"  autocomplete="name" >

                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="price" class="col-md-4 col-form-label text-md-right">Area price</label>

                        <div class="col-md-6">
                            <input  type="number" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price') }}"  >

                            @error('price')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="tags" class="col-md-4 col-form-label text-md-right">Zones</label>
                        <div class="col-md-6">
                            <select class="js-example-basic-multiple form-control" name="tags" id="zonesSelect">
                                @foreach($zones as $zone)
                                    <option  value="{{$zone->name}}">{{$zone->name}}</option>
                                @endforeach
                            </select>
                            @error('zone')
                            <strong>{{ $message }}</strong>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="state" class="col-md-4 col-form-label text-md-right">{{__('state')}}</label>
                        <div class="col-md-6">
                            <select name="state" id="state" class="form-control @error('state') is-invalid @enderror">
                                <option value="" selected>{{__('auth.select state')}}</option>
                                @foreach(\App\Models\Area::$states as $state)
                                    <option value="{{$state}}">{{$state}}</option>
                                @endforeach
                            </select>
                            @error('state')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
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



    <!-- Modal -->
    <div class="modal fade" id="zoneModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create new Zone</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="zoneForm" method="POST">
                        @csrf
                        @method('POST')
                        <div class="form-group" >
                            <label for="name">Zone Name</label>
                            <input type="text" name="name" class="form-control" id="zoneName">
                            <small id="formZoneName"></small>
                        </div>

                        <div class="form-group">
                            <select name="state" id="zoneState" class="form-control">
                                @foreach($states as $state)
                                    <option value="{{$state}}">{{$state}}</option>
                                @endforeach
                            </select>

                            <small id="formZoneState"></small>
                        </div>
                        <div class="form-group row  ">
                            <div class="col-md-6  ">
                                <button type="submit" class="btn btn-success">
                                    {{ __('Create') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection


@section('script')

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
{{--    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>--}}
    <script>
      //  $('.js-example-basic-multiple').select2();
        $("#zoneForm").submit(function (e){
            console.log('heloo');
            event.preventDefault();
            let _token = $('input[name=_token]').val();
            let name = $('#zoneName').val();
            let state = $('#zoneState').val();
            console.log(name);
            $.ajax({
                url: "{{route('areas.add-zone')}}",
                type:'POST',
                data: {
                    _token: _token,
                    name: name,
                    state: state
                },
                success:function (response){
                    console.log(response);
                    if(response){
                        $("#zonesSelect").append(`<option  value="${response.name}">${response.name}</option>`);
                        $("#zoneModal").modal('hide');
                    }
                },
                error:function (error){
                    console.log(error);
                    if(error.responseJSON.errors){
                        $("#formZoneName").text(error.responseJSON.errors.name);
                        $("#formZoneState").text(error.responseJSON.errors.type);
                    }else {
                        $("#formZoneName").text('');
                        $("#formZoneState").text('');
                    }

                }

            })
        });

    </script>
@endsection
