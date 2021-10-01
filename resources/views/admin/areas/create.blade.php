@extends('admin.layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <a href="{{route('admin.areas.index')}}">Manage Areas</a>
                <h1 class="text-center">Create Area</h1>
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
            <!-- Button trigger modal -->
                <a href="{{route('admin.zones.create')}}">{{__('auth.create')}} {{__('names.zone')}}</a>
{{--                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#zoneModal">{{__('auth.create')}} Zone</button>--}}
                <form method="POST" action="{{ route('admin.areas.store') }}">
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
                        <label for="delivery_cost" class="col-md-4 col-form-label text-md-right">Area delivery_cost</label>
                        <div class="col-md-6">
                            <input  type="number" class="form-control @error('delivery_cost') is-invalid @enderror" name="delivery_cost" value="{{ old('delivery_cost') }}"  >
                            @error('delivery_cost')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="return_cost" class="col-md-4 col-form-label text-md-right">Area return_cost</label>
                        <div class="col-md-6">
                            <input  type="number" class="form-control @error('return_cost') is-invalid @enderror" name="return_cost" value="{{ old('return_cost') }}"  >
                            @error('return_cost')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="replacement_cost" class="col-md-4 col-form-label text-md-right">Area replacement_cost</label>
                        <div class="col-md-6">
                            <input  type="number" class="form-control @error('replacement_cost') is-invalid @enderror" name="replacement_cost" value="{{ old('replacement_cost') }}"  >
                            @error('replacement_cost')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="over_weight_cost" class="col-md-4 col-form-label text-md-right">Area over_weight_cost</label>
                        <div class="col-md-6">
                            <input  type="number" class="form-control @error('over_weight_cost') is-invalid @enderror" name="over_weight_cost" value="{{ old('over_weight_cost') }}"  >
                            @error('over_weight_cost')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="delivery_time" class="col-md-4 col-form-label text-md-right">Area delivery_time</label>
                        <div class="col-md-6">
                            <input  type="number" class="form-control @error('delivery_time') is-invalid @enderror" name="delivery_time" value="{{ old('delivery_time') }}"  >
                            @error('delivery_time')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="zone_id" class="col-md-4 col-form-label text-md-right">Zones</label>
                        <div class="col-md-6">
                            <select class="js-example-basic-multiple form-control" name="zone_id" id="zonesSelect">
                                <option value="" selected>{{__('auth.select zone')}}</option>
                                @foreach($zones as $zone)
                                    <option  value="{{$zone->id}}">{{$zone->name}}</option>
                                @endforeach
                            </select>
                            @error('zone_id')
                            <strong>{{ $message }}</strong>
                            @enderror
                        </div>
                    </div>

{{--                    <div class="form-group row">--}}
{{--                        <label for="state" class="col-md-4 col-form-label text-md-right">{{__('state')}}</label>--}}
{{--                        <div class="col-md-6">--}}
{{--                            <select name="state_id" id="state_id" class="form-control @error('state_id') is-invalid @enderror">--}}
{{--                                <option value="" selected>{{__('auth.select state')}}</option>--}}
{{--                                @foreach($states as $state)--}}
{{--                                    <option value="{{$state->id}}">{{$state->name}}</option>--}}
{{--                                @endforeach--}}
{{--                            </select>--}}
{{--                            @error('state_id')--}}
{{--                            <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                            @enderror--}}
{{--                        </div>--}}
{{--                    </div>--}}




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
      {{--  $("#zoneForm").submit(function (e){--}}
      {{--      console.log('heloo');--}}
      {{--      event.preventDefault();--}}
      {{--      let _token = $('input[name=_token]').val();--}}
      {{--      let name = $('#zoneName').val();--}}
      {{--      let state = $('#zoneState').val();--}}
      {{--      console.log(name);--}}
      {{--      $.ajax({--}}
      {{--          url: "{{route('areas.add-zone')}}",--}}
      {{--          type:'POST',--}}
      {{--          data: {--}}
      {{--              _token: _token,--}}
      {{--              name: name,--}}
      {{--              state: state--}}
      {{--          },--}}
      {{--          success:function (response){--}}
      {{--              console.log(response);--}}
      {{--              if(response){--}}
      {{--                  $("#zonesSelect").append(`<option  value="${response.name}">${response.name}</option>`);--}}
      {{--                  $("#zoneModal").modal('hide');--}}
      {{--              }--}}
      {{--          },--}}
      {{--          error:function (error){--}}
      {{--              console.log(error);--}}
      {{--              if(error.responseJSON.errors){--}}
      {{--                  $("#formZoneName").text(error.responseJSON.errors.name);--}}
      {{--                  $("#formZoneState").text(error.responseJSON.errors.type);--}}
      {{--              }else {--}}
      {{--                  $("#formZoneName").text('');--}}
      {{--                  $("#formZoneState").text('');--}}
      {{--              }--}}

      {{--          }--}}

      {{--      })--}}
      {{--  });--}}

    </script>
@endsection
