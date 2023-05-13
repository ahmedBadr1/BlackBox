@extends('admin.layouts.admin')
@section('page-header')
    <h1 class="text-center">@lang("auth.create-zone")</h1>
    <div class="">
        <a href="{{route('admin.zones.index')}}" class="btn btn-primary">@lang("names.manage-zones")</a></div>

@endsection
@section('content')

        <div class="row ">
            <div class="col-md-12">
                <form method="POST" action="{{ route('admin.zones.update',$zone->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="form-group row">

                        <div class="col-md-4">
                            <label for="name" class=" col-form-label text-md-right">@lang("auth.zone-name")</label>
                            <input  type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $zone->name }}"  autocomplete="name" autofocus>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>



                        <div class="col-md-8">
                            <label for="areas" class=" col-form-label text-md-right">@lang('names.areas')</label>
                            <select class="form-control select2"  name="areas_id[]" multiple  aria-label="multiple select example">
                                @foreach($areas as $area)
                                    <option value="{{$area->id}}"  @foreach($zone->areas as $are) @if($area->id === $are->id)
                                    selected
                                        @endif
                                    @endforeach >{{$area->name}}</option>
                                @endforeach
                            </select>
                            @error('areas_id')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>


                    <div class="form-group row mb-0">
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-success">
                                @lang('auth.edit')
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

