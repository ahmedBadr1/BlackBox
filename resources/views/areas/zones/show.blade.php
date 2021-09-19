@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <a href="{{route('zones.index')}}">{{__("names.manage")}} {{__("names.zones")}}</a>
                <h1 class="text-center"> {{__("names.zone")}} {{$zone->name}}</h1>
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <label>{{__("names.branch")}} {{__("auth.name")}}</label>
                <p><b>{{$zone->name}}</b></p> <hr>
                <label>{{__("names.branch")}} {{__("auth.rabk")}}</label>
                <p><b>{{$zone->rank}}</b></p> <hr>
                <label>{{__("names.branch")}} {{__("auth.location")}}</label>
                <p><b>{{$zone->state->name}}</b></p> <hr>
                <td>@foreach($zone->areas as $area)
                        <div class="badge badge-primary"> {{$area->name}}</div>
                    @endforeach</td>

                <div class="d-flex ">
                    @can('zone-edit')
                        <a href="{{ route('zones.edit',$zone->id) }}" class="btn btn-info o">{{__("auth.edit")}}</a>
                    @endcan
                    @can('zone-delete')
                        <form class="ml-5" action="{{route('zones.destroy',$zone->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="submit" class="btn btn-danger" value="{{__("auth.delete")}}">
                        </form>
                    @endcan
                </div>


            </div>
        </div>
    </div>
@endsection

