@extends('admin.layouts.admin')

@section('content')
    <div class="container-fluid">
    <h2>All States</h2>
<div class="row">



    <table class="table table-hover">

        <thead>
        <th>Status</th>
        <th>State ID</th>
        <th>{{__('names.state')}}</th>
        <th>Branches</th>
        <th>Zones</th>
        <th>Areas</th>
        <th>Users</th>
        <th>Status</th>
        </thead>
        <tbody>
        @foreach($states as $state)
            <tr>
                <td>
{{--           <livewire:counter />         <x-toggle-state state-id="{{$state->id}}" like="{{ $state->active ? $state->active : false}}"></x-toggle-state> --}}
                    @livewire('main.toggle-button',['model' => $state,'field'=>'active'])

                </td>
                <td>{{$state->id}} </td>
                <td>{{$state->name}}
                <td>@foreach($state->branches as $branch )
                        <a href="{{route('admin.branches.show',$branch->id)}}">
                        <div class="badge badge-success">
                            {{$branch->name}}
                        </div>
                        </a>
                    @endforeach
                </td>
                <td>@foreach($state->zones as $zone )
                        <a href="{{route('admin.zones.show',$zone->id)}}">    <div class="badge badge-primary">
                            {{$zone->name}}
                        </div>
                        </a>
                    @endforeach
                </td>
                <td>@foreach($state->areas as $area )
                        <a href="{{route('admin.areas.show',$area->id)}}">    <div class="badge badge-secondary">
                                {{$area->name}}
                            </div>
                        </a>
                    @endforeach
                </td>
                <td>@foreach($state->users as $user )
                        <a href="{{route('admin.users.show',$user->id)}}">
                    <div class="badge badge-info">
                        {{$user->name}}
                    </div>
                        </a>
                    @endforeach
                </td>
                <td>{{$state->active}}</td>
            </tr>
        @endforeach

        </tbody>

    </table>
</div>
    </div>


@endsection
