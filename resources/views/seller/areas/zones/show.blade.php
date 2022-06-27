@extends('admin.layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <a href="{{route('admin.zones.index')}}">@lang("names.manage")}} @lang("names.zones")}}</a>
                <h1 class="text-center"> @lang("names.zone")}} {{$zone->name}}</h1>
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <label>@lang("names.branch")}} @lang("auth.name")}}</label>
                <p><b>{{$zone->name}}</b></p> <hr>
                <label>@lang("names.branch")}} @lang("auth.rabk")}}</label>
                <p><b>{{$zone->rank}}</b></p> <hr>
                <label>@lang("names.branch")}} @lang("auth.location")}}</label>
                <p><b>{{$zone->state->name}}</b></p> <hr>
                <td>@foreach($zone->areas as $area)
                        <div class="badge badge-primary"><a href="{{route('admin.areas.show',$area->id)}}">{{$area->name}}</a></div>
                    @endforeach</td>

                <div class="d-flex mt-3">
                    @can('zone-edit')
                        <a href="{{ route('admin.zones.edit',$zone->id) }}" class="btn btn-info o">@lang("auth.edit")}}</a>
                    @endcan
                    @can('zone-delete')
                        <form class="ml-5" action="{{route('admin.zones.destroy',$zone->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="submit" class="btn btn-danger" value="@lang("auth.delete")}}">
                        </form>
                    @endcan
                </div>


            </div>
        </div>
    </div>
@endsection

