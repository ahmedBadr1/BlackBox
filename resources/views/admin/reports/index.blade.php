@extends('admin.layouts.admin')
@section('page-header')

@endsection
@section('content')
    <div class="container-fluid">
        <h1 class="text-center">@lang('names.statics')</h1>

        <div class="row">
            <div class="col-md-6 ">
                <h2>{{ $chart1->options['chart_title'] }}</h2>
                {!! $chart1->renderHtml() !!}
            </div>
            <div class="col-md-6 ">
                <h2>{{ $chart2->options['chart_title'] }}</h2>
                {!! $chart2->renderHtml() !!}
            </div>
        </div>
    </div>

@endsection

@section('script')
    {!! $chart1->renderChartJsLibrary() !!}

    {!! $chart1->renderJs() !!}
    {!! $chart2->renderJs() !!}
{{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>--}}

{{--    <script>--}}
{{--        var ctx = document.getElementById('canvas').getContext('2d');--}}
{{--        var myChart = new Chart(ctx, {--}}
{{--            type: 'bar',--}}
{{--            data: {--}}
{{--                labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],--}}
{{--                datasets: [{--}}
{{--                    label: '# of Votes',--}}
{{--                    data: [12, 19, 3, 5, 2, 3],--}}
{{--                    backgroundColor: [--}}
{{--                        'rgba(255, 99, 132, 0.2)',--}}
{{--                        'rgba(54, 162, 235, 0.2)',--}}
{{--                        'rgba(255, 206, 86, 0.2)',--}}
{{--                        'rgba(75, 192, 192, 0.2)',--}}
{{--                        'rgba(153, 102, 255, 0.2)',--}}
{{--                        'rgba(255, 159, 64, 0.2)'--}}
{{--                    ],--}}
{{--                    borderColor: [--}}
{{--                        'rgba(255, 99, 132, 1)',--}}
{{--                        'rgba(54, 162, 235, 1)',--}}
{{--                        'rgba(255, 206, 86, 1)',--}}
{{--                        'rgba(75, 192, 192, 1)',--}}
{{--                        'rgba(153, 102, 255, 1)',--}}
{{--                        'rgba(255, 159, 64, 1)'--}}
{{--                    ],--}}
{{--                    borderWidth: 1--}}
{{--                }]--}}
{{--            },--}}
{{--            options: {--}}
{{--                scales: {--}}
{{--                    y: {--}}
{{--                        beginAtZero: true--}}
{{--                    }--}}
{{--                }--}}
{{--            }--}}
{{--        });--}}
{{--    </script>--}}
@endsection
