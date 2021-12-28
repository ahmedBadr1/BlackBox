@extends('admin.layouts.admin')
@section('page-header')
    <h1 class="text-center">@lang('names.all-locations')</h1>
    @can('plan-create')
        <a href="{{route('admin.locations.create')}}" class="btn btn-success">@lang('auth.create-location')</a>
    @endcan

@endsection
@section('content')

        <div class="row justify-content-center">
            <div class="col-md-12">
                <table class="table table-hover">

                    <thead>
                    <th>@lang('auth.id')</th>
                    <th>@lang('auth.location-name')</th>
                    <th>@lang('auth.state')</th>
                    <th>@lang('auth.city')</th>
                    <th>@lang('auth.address')</th>
                    <th>@lang('auth.actions')</th>
                    </thead>

                    <tbody>
                    @foreach($locations as $location)
                        <tr>
                            <td>{{$location->id}} </td>
                            <td> <a href="{{ route('admin.locations.show',$location->id) }}"> {{$location->name}} </a></td>
                            <td>{{$location->state->name}}</td>
                            <td><a href="{{ route('admin.areas.show',$location->area->id) }}"> {{$location->area->name}} </a></td>
                            <td>{{$location->building}} , {{$location->floor}} {{$location->apatrment}}</td>
                            <td>{{$location->longitude}}</td>
                            <td>{{$location->latitude}}</td>

                            <td class="d-flex justify-content-between">
                                <a href="{{ route('admin.locations.edit',$location->id) }}" class="btn btn-info">@lang('auth.edit')</a>
                               <form action="{{route('admin.locations.destroy',$location->id) }}" method="POST">
                                   @csrf
                                   @method('DELETE')
                                <input type="submit" class="btn btn-danger" name="delete" value="@lang('auth.delete')">
                               </form>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>

                </table>


            </div>
        </div>



@endsection

