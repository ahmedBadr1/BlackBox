@extends('admin.layouts.admin')
@section('page-header')
    <h2 class="text-center">@lang('names.all-permissions')</h2>
@endsection
@section('content')

        <div class="row justify-content-center">
            <div class="col-md-12">


                @foreach($permissions as $permission)
                    <div class="d-flex w-25">
                        <p class="">{{$permission->name}}</p>
                    </div>

                @endforeach
            </div>
        </div>
@endsection

