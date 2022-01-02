
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <div class="card-title">@lang('names.request-pickup')</div>
                <form action="#" wire:submit.prevent="save">
                   <div class="form-group row ">
                       <div class="col-md-4">
                           <label for="due_to" class=" col-form-label text-md-right"> @lang("auth.due-to")</label>
                           <input  type="datetime-local"  class="form-control @error('due_to') is-invalid @enderror" wire:model.lazy="due_to"  value="{{ old('due_to') }}"  >
                           @error('due_to')
                           <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                           @enderror
                       </div>
                       <div class="col-md-6">
                           <label for="location_id" class=" col-form-label text-md-right"> @lang("auth.location")</label>
                           <select   class="form-control @error('location_id') is-invalid @enderror" wire:model.lazy="location_id"  value="{{ old('due_to') }}"  >
                               <option value="{{$businessLocation->id}}">{{$businessLocation->name}}</option>
                                   @foreach($locations as $location)
                                       <option value="{{$location->id}}">{{$location->name}}</option>
                                   @endforeach
                           </select>
                           @error('location_id')
                           <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                           @enderror
                       </div>
                       <div class=" col-md-2  mt-2 mt-md-auto ">
                           <button type="submit" class="btn btn-success-gradient">
                               @lang('auth.create')
                           </button>
                       </div>
                       <div class="col-md-12">
                           <label for="notes" class=" col-form-label text-md-right"> @lang("auth.notes")</label>
                           <input  type="text" class="form-control @error('notes') is-invalid @enderror" wire:model.lazy="notes"  value="{{ old('notes') }}"  >
                           @error('notes')
                           <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                           @enderror
                       </div>



                   </div>
                </form>
            </div>
        </div>
    </div>

