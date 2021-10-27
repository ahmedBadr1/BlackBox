<div>
    <h3 class=" card-title">@lang('messages.business-info')</h3>

    <form action="{{route('setting')}}" method="post">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <label for="email" class=" col-form-label text-md-right">{{ __('auth.business-name') }}</label>
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                       name="name" value="{{ $business->name ?? '' }}" >
                @error('name')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="contact" class=" col-form-label text-md-right">{{ __('auth.business-contact') }}</label>

                <input id="contact" type="text" class="form-control @error('contact') is-invalid @enderror"
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

                <select id="industry" type="text" class="form-control @error('industry') is-invalid @enderror"
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

                <select id="channel" type="text" class="form-control @error('channel') is-invalid @enderror"
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

                <input id="url" type="url" class="form-control @error('url') is-invalid @enderror" name="url" value="{{ $business->url ?? '' }}">

                @error('url')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
            </div>

        </div>
        <div class="row justify-content-center mt-3">
            <div class="col-md-4">
                <button class="btn btn-info-gradient">@lang('auth.reset')</button>
                <button class="btn btn-success-gradient" type="submit">@lang('auth.save')</button>
            </div>
        </div>
    </form>

</div>
