@extends('seller.layouts.seller')

@section('content')

    <h2>All Areas</h2>

    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <table class="table table-hover">

        <thead>
        <th scope="col">Area ID</th>
        <th scope="col">Area</th>
        <th scope="col">Cost</th>
        <th scope="col">State</th>
        </thead>
        <tbody>
        @foreach($areas as $area)
            <tr>
                <td  scope="row" data-label="Area ID">{{$area->id}} </td>
                <td data-label="Area"> <a href="{{ route('admin.areas.show',$area->id) }}"> {{$area->name}} </a></td>
                <td data-label="Cost">{{$area->delivery_cost}}</td>
                <td data-label="State">{{$area->state->name}}</td>
            </tr>
        @endforeach

        </tbody>

    </table>
    <div class="d-flex justify-content-center">
    {{ $areas->links('vendor.pagination.bootstrap-4') }}
    </div>
@endsection

@push('styles')
    <style>
        @media screen and (max-width: 600px) {
            table {
                border: 0;
            }

            table caption {
                font-size: 1.3em;
            }

            table thead {
                border: none;
                clip: rect(0 0 0 0);
                height: 1px;
                margin: -1px;
                overflow: hidden;
                padding: 0;
                position: absolute;
                width: 1px;
            }

            table tr {
                border-bottom: 3px solid #ddd;
                display: block;
                margin-bottom: .625em;
            }

            table td {
                border-bottom: 1px solid #ddd;
                display: block;
                font-size: .8em;
                text-align: right;
            }

            table td::before {
                /*
                * aria-label has no advantage, it won't be read inside a table
                content: attr(aria-label);
                */
                content: attr(data-label);
                float: left;
                font-weight: bold;
                text-transform: uppercase;
            }

            table td:last-child {
                border-bottom: 0;
            }
        }


    </style>
@endpush
