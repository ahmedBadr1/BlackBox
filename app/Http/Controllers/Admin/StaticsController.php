<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class StaticsController extends Controller
{
    //
    public function index()
    {
        $chart_options = [
            'chart_title' => 'Cash with delivery',
            'chart_type' => 'line',
            'report_type' => 'group_by_relationship',
            'model' => 'App\Models\Order',

            'relationship_name' => 'delivery', // represents function orders() on User model
            'group_by_field' => 'name', // users.name

            'aggregate_function' => 'sum',
            'aggregate_field' => 'total',

            'filter_field' => 'created_at',
            'filter_days' => 30, // show only transactions for last 30 days
            'filter_period' => 'week', // show only transactions for this week
        ];
        $chart1 = new LaravelChart($chart_options);

        $chart_options2 = [
            'chart_title' => 'Balance of sellers',
            'chart_type' => 'pie',
            'report_type' => 'group_by_relationship',
            'model' => 'App\Models\Order',
            'chart_color' => "#191919",

            'relationship_name' => 'user', // represents function orders() on User model
            'group_by_field' => 'name', // users.name

            'aggregate_function' => 'sum',
            'aggregate_field' => 'total',

            'filter_field' => 'created_at',
            'filter_days' => 30, // show only transactions for last 30 days
            'filter_period' => 'week', // show only transactions for this week
        ];
        $chart2 = new LaravelChart($chart_options2);


        return view('admin.reports.index',compact('chart1','chart2'));
    }
}
