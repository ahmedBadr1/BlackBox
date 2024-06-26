<div>
    <div class="container-fluid ">
        <div class="row my-3 d-flex">
            <div class="col-md-6">
                <input type="search" wire:model.debounce.400ms="search" class="form-control" placeholder="search in names">
            </div>
            <div class="col-xs-2">
                <select wire:model="orderBy" class="form-control">
                    <option>Id</option>
                    <option>Name</option>
                    <option>Email</option>
                    <option>Phone</option>
                    <option>active</option>
                </select>
            </div>
            <div class="col-xs-2">
                <select wire:model="orderAsc" class="form-control">
                    <option value="1">Asc</option>
                    <option value="0">Desc</option>
                </select>
            </div>
            <div class="col-xs-2">
                <select wire:model="perPage" class="form-control">
                    <option>5</option>
                    <option>10</option>
                    <option>25</option>
                    <option>50</option>
                    <option>100</option>
                </select>
            </div>
        </div>
        <div class="row">
            <table class="table table-hover table-responsive-md">
                <thead>
                <th class="border  py-2">{{__('auth.id')}}</th>
                <th class="border  py-2">{{__('auth.name')}}</th>
                <th class="border  py-2">{{__('auth.email')}}</th>
                <th class="border  py-2">{{__('auth.phone')}}</th>
                <th class="border  py-2">{{__('names.role')}}</th>
                <th class="border  py-2">{{__('names.branch')}}</th>
                <th class="border  py-2">{{__('auth.status')}}</th>
                <th class="border  py-2">{{__('auth.edit')}}</th>
                <th class="border  py-2">{{__('auth.delete')}}</th>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td class="border  py-2">{{$user->id}} </td>
                        <td class="border  py-2"> <a href="{{ route('admin.users.show',$user->id) }}"> {{$user->name}} </a></td>
                        <td class="border  py-2">{{$user->email}} </td>
                        <td class="border  py-2">{{$user->phone}} </td>
                        <td class="border  py-2"><a href="{{ route('admin.roles.show',  $user->roles[0]->id) }}">{{$user->getRoleNames()[0]}}</a></td>
                        <td class="border  py-2">@if ($user->branch_id)
                                <a href="{{route('admin.branches.show',$user->branch_id)}}" class="btn btn-outline-success"> {{ $user->branch->name  }}</a>
                            @else
                                @can('user-assign')
                                    <a href="{{route('admin.branches.index')}}" class="btn btn-outline-success">@lang('auth.assign')</a>
                                @endcan
                            @endif
                        </td >

                        @can('user-active')
                            <td class="border  py-2">
{{--                                {{$user->active}}--}}
{{--                                @livewire('main.toggle-button',['model' => $user,'field'=>'active'])--}}
                                @if ($user->id !== auth()->id())
                                <livewire:main.toggle-button :model="$user" :field="'active'" :key="$user->id">
                                @else
                                    <p>{{ __('messages.cannot-disable') }}</p>
                                    @endif
                            </td>
                        @endcan
                        @can('user-edit')
                            <td class="border  py-2"><a href="{{ route('admin.users.edit',$user->id) }}" class="btn btn-info">{{__('auth.edit')}}</a></td>
                        @endcan
                        @can('user-delete')
                            <td class="border  py-2">
                                <form action="{{route('admin.users.destroy',$user->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" class="btn btn-danger" name="delete" value="{{__('auth.delete')}}">
                                </form>
                            </td>
                        @endcan
                    </tr>
                @endforeach

                </tbody>

            </table>
        </div>
        <div class="d-flex">
            {{ $users->links() }}
        </div>
    </div>


</div>






