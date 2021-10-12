@extends('admin.layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h1 class="text-center">All Locations</h1>
                @can('plan-create')
                    <a href="{{route('admin.locations.create')}}" class="btn btn-success">Create Location</a>
                @endcan


                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <table class="table table-hover">

                    <thead>
                    <th>ID</th>
                    <th>Name</th>
                    <th>state</th>
                    <th>city</th>
                    <th>address</th>
                    <th>longitude</th>
                    <th>latitude</th>
                    <th>edit</th>
                    <th>delete</th>
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

                            <td><a href="{{ route('admin.locations.edit',$location->id) }}" class="btn btn-info">edit</a></td>
                            <td>
                               <form action="{{route('admin.locations.destroy',$location->id) }}" method="POST">
                                   @csrf
                                   @method('DELETE')
                                <input type="submit" class="btn btn-danger" name="delete" value="delete">
                               </form>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>

                </table>


            </div>
        </div>
    </div>


@endsection

