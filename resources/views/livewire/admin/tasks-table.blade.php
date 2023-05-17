<div>
    <div class="container-fluid ">
        <div class="row my-3 d-flex">
            <div class="col-md-6">
                <input type="search" wire:model="search" class="form-control" placeholder="search in tasks">
            </div>
            <div class="col-xs-2">
                <select wire:model="orderDesc" class="form-control">
                    <option value="1">Desc</option>
                    <option value="0">Asc</option>
                </select>
            </div>
            <div class="col-xs-2">
                <select wire:model="orderBy" class="form-control">
                    <option value="due_to">Due To</option>
                    <option value="created_at">Created</option>
                </select>
            </div>
            <div class="col-xs-2">

                <select wire:model="date" class="form-control">
                    <option value="today">today</option>
                    <option value="tomorrow">tomorrow</option>
                    <option value="week">week</option>
                    <option value="month">month</option>
                </select>
                <label for="">Date</label>
            </div>
            <div class="col-2">

                <select wire:model="type" class="form-control">
                    <option value="all">All</option>
                @foreach($types as $typ)
                        <option value="{{$typ}}">{{$typ}}</option>
                    @endforeach
                </select>
                <label for="">Type</label>
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
                <th>@lang('auth.id')</th>
                <th>@lang('auth.username')</th>
                <th>@lang('auth.type')</th>
                <th>@lang('auth.assign-to')</th>
                <th>@lang('auth.created-at')</th>
                <th>@lang('auth.due-to')</th>

                </thead>

                <tbody>

                @forelse($tasks as $task)

                    <tr>
                        <td>{{$task->id}} </td>
                        <td> <a href="{{ route('admin.users.show',$task->user->id) }}"> {{$task->user->name}} </a></td>

                        <td>{{$task->type}} </td>
                        @if($task->delivery_id)
                            <td><a href="{{ route('admin.users.show',$task->delivery->id) }}"> {{$task->delivery->name}} </a> </td>
                        @else
                            <td><a href="{{route('admin.tasks.assign')}}" class="btn btn-primary">@lang('auth.assign')</a></td>
                        @endif
                        <td>
                            {{$task->created}}
                        </td>
                        <td>
                            {{$task->due}}
                        </td>

                        @can('task-edit')
                            <td><a href="{{ route('admin.tasks.edit',$task->id) }}" class="btn btn-info">@lang('auth.edit')</a></td>
                        @endcan
                        @can('task-delete')
                            <td>
                                <form action="{{route('admin.tasks.destroy',$task->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" class="btn btn-danger" name="delete" value="@lang('auth.delete')">
                                </form>
                            </td>
                        @endcan
                        @can('task-done')
                            <td>
                                <form action="{{route('admin.tasks.done',$task->id) }}" method="POST">
                                    @csrf
                                    <input type="submit" class="btn btn-secondary"  value="@lang('auth.done')">
                                </form>
                            </td>
                        @endcan
                    </tr>
                @empty
                    <tr>
                        <td colspan="3">No Tasks Found</td>
                    </tr>
                @endforelse
                </tbody>

            </table>

        </div>

        <div class="d-flex justify-content-center">
            {{ $tasks->links() }}
        </div>
    </div>
</div>
