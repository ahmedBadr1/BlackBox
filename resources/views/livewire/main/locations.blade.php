<div class="form-group row">
    <label for="role" class="col-md-4 col-form-label text-md-right">@lang('names.location')</label>
    <div class="col-md-6">
        <select name="location_id" class="form-select" aria-label="Default select example" >
            <option value="">Select a Location</option>
            @foreach($locations as $location)
                <option value="{{$location->id}}">{{$location->name}}</option>
            @endforeach
        </select>
        @error('location_id')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        <label for="">
            <a href="{{ route('admin.locations.create') }}">+ Add new location</a>

{{--        <input type="checkbox" class="btn-link" wire:toggle="aria" value="1"  >--}}
        </label>

    </div>

    <div class="modal fade" id="locationCreate" tabindex="-1" aria-labelledby="locationCreate"  aria-hidden="@if($aria)true@else false @endif">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

</div>

