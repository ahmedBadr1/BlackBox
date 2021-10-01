@extends('admin.layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h1 class="text-center">All Plans</h1>
                @can('plan-create')
                    <a href="{{route('admin.plans.create')}}" class="btn btn-success">Create Plan</a>
                @endcan
                    <a href="{{route('admin.features')}}" class="btn btn-outline-info">Features</a>

                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <table class="table table-hover">

                    <thead>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Order Count</th>
                    <th>Pickup Cost</th>
                    <th>Features</th>
                    </thead>

                    <tbody>

                    @foreach($plans as $plan)

                        <tr>
                            <td>{{$plan->id}} </td>
                            <td> <a href="{{ route('admin.plans.show',$plan->id) }}"> {{$plan->name}} </a></td>

                            <td>{{$plan->orders_count}} </td>
                            <td>{{$plan->pickup_cost}} </td>

                            <td>
                                @forelse($plan->features as $feature)
                                   <span class="badge badge-primary">
                                       <a href="{{route('admin.features.show',$feature->feature_id)}}">{{ $feature->name }}</a>
                                   </span>
                                @empty
                                    No Features
                                @endforelse
                                </td>
                            @can('plan-edit')
                                <td><a href="{{ route('admin.plans.edit',$plan->id) }}" class="btn btn-info">edit</a></td>
                            @endcan
                            @can('plan-delete')
                            <td>
                               <form action="{{route('admin.plans.destroy',$plan->id) }}" method="POST">
                                   @csrf
                                   @method('DELETE')
                                <input type="submit" class="btn btn-danger" name="delete" value="delete">
                               </form>
                            </td>
                            @endcan
                        </tr>
                    @endforeach

                    </tbody>

                </table>


            </div>
        </div>
    </div>


@endsection

