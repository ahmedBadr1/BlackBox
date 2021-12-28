<div>
    <form action="{{route('password-change')}}" method="post" >
        @csrf
        <div class="row">
            <div class="col-md-12">
                <label for="password" class=" col-form-label text-md-right">@lang('auth.current-password') }}</label>
                <input wire:mode.lazy="password"  type="password" class="form-control @error('password') is-invalid @enderror"
                       name="password"  >
                @error('password')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="email" class=" col-form-label text-md-right">@lang('auth.new-password') }}</label>
                <input wire:mode.lazy="new_password" type="password" class="form-control @error('new_password') is-invalid @enderror">
                @error('new_password')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="con_password" class=" col-form-label text-md-right">@lang('auth.con-password') }}</label>
                <input wire:mode.lazy="con_password"   type="password" class="form-control @error('con_password') is-invalid @enderror">
                @error('con_password')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
            </div>


        </div>
        <div class="row mt-2 ">
            <div class="col-md-4">
                <button class="btn btn-success-gradient" type="submit">@lang('auth.save')</button>
            </div>
        </div>

    </form>
</div>
