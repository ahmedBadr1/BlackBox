@extends('admin.layouts.admin')

@section('page-header')
    <h2>@lang('names.all-states')</h2>
@endsection

@section('content')
<div class="row">
    <table class="table table-hover table-responsive-md">

        <thead>
        <th>@lang('auth.id')</th>
        <th>@lang('auth.state')</th>
        <th>@lang('names.branches')</th>
        <th>@lang('names.areas')</th>
{{--        <th>@lang('auth.status')</th>--}}
        </thead>
        <tbody>
        @foreach($states as $state)
            <tr>

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

                <td>@foreach($state->areas as $area )
                        <a href="{{route('admin.areas.show',$area->id)}}">    <div class="badge badge-secondary">
                                {{$area->name}}
                            </div>
                        </a>
                    @endforeach
                </td>
                <td>
                    {{--           <livewire:counter />         <x-toggle-state state-id="{{$state->id}}" like="{{ $state->active ? $state->active : false}}"></x-toggle-state> --}}
{{--                    @livewire('main.toggle-button',['model' => $state,'field'=>'active'])--}}
                </td>
            </tr>
        @endforeach

        </tbody>

    </table>
</div>



@endsection
