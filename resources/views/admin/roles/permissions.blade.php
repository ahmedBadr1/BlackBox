@extends('admin.layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h2 class="text-center">{{__('names.all')}} {{__('names.permissions')}}</h2>

                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#permissionModal">{{__('auth.create')}} {{__('names.permission')}}</button>
                @foreach($permissions as $permission)
                    <div class="d-flex w-25">
                        <p class="">{{$permission->name}}</p>
                        <div class="ml-auto">
                        <form action="{{route('admin.permission.delete',$permission->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="submit" class="btn btn-danger" value="delete">
                        </form>
                        </div>

                    </div>

                @endforeach
            </div>
        </div>
    </div>



    <!-- Modal -->
    <div class="modal fade" id="permissionModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{__('auth.create')}} {{__('names.new')}} {{__('names.permissions')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{route('admin.roles.permissions')}}">
                        @csrf

                        <div class="form-group" >
                            <label for="name">{{__('names.permission')}} {{__('auth.name')}}</label>
                            <input type="text" name="name" class="form-control" id="fieldName">
                            <small id="formFieldName"></small>
                        </div>
                        @error('name')
                        <strong>{{ $message }}</strong>
                        @enderror

                        <div class="form-group row  ">
                            <div class="col-md-6  ">
                                <button type="submit" class="btn btn-success">
                                    {{ __('Create') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
