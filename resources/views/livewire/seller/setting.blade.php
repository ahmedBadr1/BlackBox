<div class="col-md-12">
    <div class="border">
        <div class="bg-gray-100 nav-bg">
            <nav class="nav nav-tabs">
                <a class="nav-link active" data-toggle="tab" href="#business">@lang('names.business')</a>
                <a class="nav-link" data-toggle="tab" href="#changePassword">@lang('names.change-password')</a>
                <a class="nav-link" data-toggle="tab" href="#invite">@lang('names.invite')</a>
            </nav>
        </div>
        <div class="card-body tab-content">
            @if($businessSetting)
            <div class="tab-pane active show " id="business">
                <livewire:seller.business-setting />
                <livewire:seller.business-location />
            </div>
            @endif
            @if($resetPassword)
            <div class="tab-pane" id="changePassword">
                <h3 class=" card-title">@lang('messages.change-password')</h3>

                <livewire:seller.change-password />

            </div>
                @endif
            @if($invite)
                <div class="tab-pane" id="invite">
                    <h3 class=" card-title">@lang('messages.business-invite')</h3>

                    <form action="{{route('business-invite')}}" method="post">
                        @csrf
                        <div class="row">

                            <div class="col-md-8">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                       name="email" placeholder="@lang('auth.enter-email')" >
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-4 mt-2 mt-md-0">
                                <button class="btn btn-primary-gradient" type="submit">@lang('auth.invite')</button>
                            </div>


                        </div>

                    </form>

                </div>
            @endif
        </div>
    </div>

</div>
