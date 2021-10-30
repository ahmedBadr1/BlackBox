<div>
    <h3 class=" card-title">@lang('messages.business-info')</h3>

    <form action="#" method="post" wire:submit.prevent="save">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <label for="email" class=" col-form-label text-md-right">{{ __('auth.business-name') }}</label>
                <input wire:model.lazy="name"  type="text" class="form-control @error('name') is-invalid @enderror"
                       name="name" value="{{ $business->name ?? '' }}" >
                @error('name')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="contact" class=" col-form-label text-md-right">{{ __('auth.business-contact') }}</label>

                <input wire:model.lazy="contact" type="text" class="form-control @error('contact') is-invalid @enderror"
                       name="contact" value="{{ $business->contact ?? '' }}">

                @error('contact')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <label for="industry" class=" col-form-label text-md-right">{{ __('auth.business-field') }}</label>

                <select wire:model.lazy="industry" type="text" class="form-control @error('industry') is-invalid @enderror"
                        name="industry"  >
                    <option value="">@lang('auth.select')</option>
                    @foreach($industries as $industry)
                        <option value="{{$industry}}" @isset($business->industry) @if($business->industry === $industry) selected @endif @endisset>{{$industry}}</option>
                    @endforeach
                </select>

                @error('industry')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
            </div>
            <div class="col-md-3">
                <label for="channel" class=" col-form-label text-md-right">{{ __('auth.store') }}</label>

                <select wire:model.lazy="channel" type="text" class="form-control @error('channel') is-invalid @enderror"
                        name="channel"  >
                    <option value="">@lang('auth.select')</option>
                    @foreach($channels as $channel)
                        <option value="{{$channel}}" @isset($business->industry) @if($business->channel == $channel) selected @endif @endisset>{{$channel}}</option>
                    @endforeach
                </select>

                @error('industry')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="url" class=" col-form-label text-md-right">{{ __('auth.business-url') }}</label>

                <input wire:model.lazy="url" type="url" class="form-control @error('url') is-invalid @enderror" name="url" value="{{ $business->url ?? '' }}">

                @error('url')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
            </div>

        </div>


    <h3 class=" card-title mt-3">@lang('messages.business-location')</h3>


        <div class="form-group row">
            <div class="col-md-6">
                <label for="name" class=" col-form-label text-md-right"> {{__("auth.name")}}</label>
                <input  type="text" class="form-control @error('name') is-invalid @enderror" wire:model.lazy="location_name"    >
                @error('name')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
            </div>
            <div class="col-md-3 ">
                <label for="state_id" class="col-form-label text-md-right"> {{__("names.state")}}</label>
                <select name="state_id" class="form-control " wire:model.lazy="state_id" >
                    <option value="">select State</option>
                    @foreach($states as $state)
                        <option value="{{$state->id}}" >{{$state->name}}</option>
                    @endforeach
                </select>
                @error('state_id')

                <strong>{{ $message }}</strong>

                @enderror
            </div>

            <div class="col-md-3">
                <label for="area_id" class="col-form-label text-md-right"> {{__("names.area")}}</label>
                <select name="area_id"  class="form-control "  wire:model.lazy="area_id">
                    <option value="">select Area</option>
                    @foreach($areas as $area)
                        <option value="{{$area->id}}"  >{{$area->name}}</option>
                    @endforeach
                </select>
                @error('area_id')
                <strong>{{ $message }}</strong>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <div class="col-md-3">
                <label for="orders_count" class=" col-form-label text-md-right">{{__("auth.street")}}</label>
                <input wire:model.lazy="street" type="text" class="form-control @error('street') is-invalid @enderror" name="street" value="{{ $location->street ?? '' }}" >
                @error('street')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
            </div>
            <div class="col-md-3">
                <label for="building" class="col-md-4 col-form-label text-md-right">{{__("auth.building")}}</label>
                <input wire:model.lazy="building" type="text" class="form-control @error('building') is-invalid @enderror" name="building" value="{{ $location->building ?? '' }}" >
                @error('building')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
            </div>
            <div class="col-md-3">
                <label for="floor" class=" col-form-label text-md-right">{{__("auth.floor")}}</label>
                <input wire:model.lazy="floor" type="text" class="form-control @error('floor') is-invalid @enderror" name="floor" value="{{ $location->floor ?? '' }}" >
                @error('floor')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
            </div>
            <div class="col-md-3">
                <label for="apartment" class=" col-form-label text-md-right">{{__("auth.apartment")}}</label>
                <input wire:model.lazy="apartment" type="text" class="form-control @error('apartment') is-invalid @enderror" name="apartment" value="{{ $location->apartment ?? '' }}" >
                @error('apartment')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <div class="col-md-4">
                <label for="landmarks" class="col-form-label text-md-right">{{__("auth.landmarks")}}</label>
                <input wire:model.lazy="landmarks" type="text" class="form-control @error('landmarks') is-invalid @enderror" name="landmarks" value="{{ $location->landmarks ?? '' }}" >
                @error('landmarks')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
            </div>
{{--            <div class="col-md-4">--}}
{{--                <label for="latitude" class="col-form-label text-md-right">{{__("auth.latitude")}}</label>--}}
{{--                <input wire:model.lazy="latitude" type="number" step="00.000001" class="form-control @error('latitude') is-invalid @enderror" name="latitude" value="{{ $location->latitude ?? '' }}" >--}}
{{--                @error('latitude')--}}
{{--                <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                @enderror--}}
{{--            </div>--}}
{{--            <div class="col-md-4">--}}
{{--                <label for="longitude" class=" col-form-label text-md-right">{{__("auth.longitude")}}</label>--}}
{{--                <input wire:model.lazy="longitude" type="number"  step="00.000001" class="form-control @error('longitude') is-invalid @enderror" name="longitude" value="{{ $location->longitude ?? '' }}" >--}}
{{--                @error('longitude')--}}
{{--                <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                @enderror--}}
{{--            </div>--}}
        </div>

        <div class="row justify-content-center mt-3">
            <div class="col-md-4">
                <button class="btn btn-info-gradient">@lang('auth.reset')</button>
                <button class="btn btn-success-gradient" type="submit">@lang('auth.save')</button>
            </div>
        </div>


    </form>
</div>
