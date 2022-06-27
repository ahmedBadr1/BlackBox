<div>


    <div class="panel-group1" id="accordion">
        <div class="panel panel-default  mb-4">
            <div class="panel-heading1 bg-{{$color}}-gradient ">
                <h4 class="panel-title1">
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#create" aria-expanded="true">@lang('auth.'.$title) @lang('names.locations')</a>
                </h4>
            </div>
            <div id="create" class="panel-collapse collapse show" role="tabpanel" aria-expanded="true" style="">
                <div class="panel-body border">
                    <form method="POST"  action="#" wire:submit.prevent="save" >
                        @csrf
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="name" class=" col-form-label text-md-right"> @lang("auth.name")</label>
                                <input  type="text" class="form-control @error('name') is-invalid @enderror" wire:model.lazy="name" name="name" value="{{ old('name') }}"  >
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-3 ">
                                <label for="state_id" class="col-form-label text-md-right"> @lang("names.state")</label>
                                <select name="state_id" class="form-control " wire:model.lazy="state_id" >
                                    <option value="">select State</option>
                                    @foreach($states as $state)
                                        <option value="{{$state->id}}">{{$state->name}}</option>
                                    @endforeach
                                </select>
                                @error('state_id')

                                <strong>{{ $message }}</strong>

                                @enderror
                            </div>
                            <div class="col-md-3">
                                <label for="area_id" class="col-form-label text-md-right"> @lang("names.area")</label>
                                <select name="area_id"  class="form-control "  wire:model.lazy="area_id">
                                    <option value="">select Area</option>
                                    @foreach($areas as $area)
                                        <option value="{{$area->id}}">{{$area->name}}</option>
                                    @endforeach
                                </select>
                                @error('area_id')
                                <strong>{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-3">
                                <label for="orders_count" class=" col-form-label text-md-right">@lang("auth.street")</label>
                                <input wire:model.lazy="street" type="text" class="form-control @error('street') is-invalid @enderror" name="street" value="{{ old('street') }}" >
                                @error('street')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <label for="building" class="col-md-4 col-form-label text-md-right">@lang("auth.building")</label>
                                <input wire:model.lazy="building" type="text" class="form-control @error('building') is-invalid @enderror" name="building" value="{{ old('building') }}" >
                                @error('building')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <label for="floor" class=" col-form-label text-md-right">@lang("auth.floor")</label>
                                <input wire:model.lazy="floor" type="text" class="form-control @error('floor') is-invalid @enderror" name="building" value="{{ old('floor') }}" >
                                @error('floor')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <label for="apartment" class=" col-form-label text-md-right">@lang("auth.apartment")</label>
                                <input wire:model.lazy="apartment" type="text" class="form-control @error('apartment') is-invalid @enderror" name="apartment" value="{{ old('apartment') }}" >
                                @error('apartment')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-4">
                                <label for="landmarks" class="col-form-label text-md-right">@lang("auth.landmarks")</label>
                                <input wire:model.lazy="landmarks" type="text" class="form-control @error('landmarks') is-invalid @enderror" name="landmarks" value="{{ old('landmarks') }}" >
                                @error('landmarks')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
{{--                            <div class="col-md-4">--}}
{{--                                <label for="latitude" class="col-form-label text-md-right">@lang("auth.latitude")}}</label>--}}
{{--                                <input wire:model.lazy="latitude" type="number" step="00.000001" class="form-control @error('latitude') is-invalid @enderror" name="latitude" value="{{ old('latitude') }}" >--}}
{{--                                @error('latitude')--}}
{{--                                <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                            <div class="col-md-4">--}}
{{--                                <label for="longitude" class=" col-form-label text-md-right">@lang("auth.longitude")}}</label>--}}
{{--                                <input wire:model.lazy="longitude" type="number"  step="00.000001" class="form-control @error('longitude') is-invalid @enderror" name="longitude" value="{{ old('longitude') }}" >--}}
{{--                                @error('longitude')--}}
{{--                                <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 ">
                                <button type="submit" class="btn btn-{{$color}}-gradient">
                                    @lang('auth.'.$button)
                                </button>
                            </div>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>




</div>
