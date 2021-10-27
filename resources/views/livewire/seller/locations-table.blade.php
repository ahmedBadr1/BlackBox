<div class="">
    @if($locations->count() > 0)
    <table class="table table-hover table-responsive ">

        <thead >

        <th>@lang('auth.name')</th>
        <th>@lang('auth.state')</th>
        <th>@lang('auth.city')</th>
        <th>@lang('auth.address')</th>
        <th>@lang('auth.edit')</th>
        <th>@lang('auth.delete')</th>
        </thead>

        <tbody >
        @foreach($locations as $location)
            <tr>
                <td> <a href="{{ route('admin.locations.show',$location->id) }}"> {{$location->name}} </a></td>
                <td>{{$location->state->name}}</td>
                <td><a href="{{ route('admin.areas.show',$location->area->id) }}"> {{$location->area->name}} </a></td>
                <td>{{Str::limit($location->street. ', '. $location->building . ', '.$location->floor. ', '.$location->apatrment, 60) }}</td>

                <td><a href="{{ route('admin.locations.edit',$location->id) }}"  class="btn btn-info">edit</a></td>
                <td>
                    <button wire:click="delete({{ $location->id }})" class="btn btn-danger-gradient">@lang('auth.delete')</button>
                </td>
            </tr>
        @endforeach

        </tbody>

    </table>
    @endif
</div>





