<?php

namespace App\Http\Controllers\Graph;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Central;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\DatabaseLog;
use Khill\Lavacharts\Lavacharts;

class GraphController extends Controller
{
    public static function lineChart()
    {

        $response = Central::where("user_id", "=", Auth::user()->id)->first();
        if (!$response) {
            return view('dashboard', compact('response'));
        }
        $response = $response->api_key;

        DB::connection('mysql');
        config(['database.connections.mysql.database' => $response]);
        DB::purge('mysql');
        DB::reconnect('mysql');


        //         SELECT
        //     HOUR(event_time) AS 'hour',
        // 	COUNT(*) AS 'number_of_times'
        // FROM database_log
        // GROUP BY HOUR(event_time);
        // $data = DatabaseLog::select(array(DB::raw('HOUR(event_time)'), DB::raw('COUNT(*)')))->groupBy(DB::raw('HOUR(event_time)'))->get()->toArray();

        $lava = new Lavacharts; // See note below for Laravel

        $votes  = $lava->DataTable();

        $votes->addStringColumn('Food Poll')
            ->addNumberColumn('Votes')
            ->addRow(['Tacos',  5822])
            ->addRow(['Salad',  5274])
            ->addRow(['Pizza',  6241])
            ->addRow(['Apples', 9631])
            ->addRow(['Fish',   8521]);

        $lava->BarChart('Votes', $votes);

        // foreach ($data as  $value) {
        //     $votes->addRow(['2022-09-6' . $value['HOUR(event_time)'], $value['COUNT(*)']]);
        //     // ->addRow(['2014-1
        // }

        return view('larachart', compact('lava'));
    }

    // public static function rendering()
    // {

    //     $data = DatabaseLog::table()->select(array(DB::raw('COUNT(id)'), 'method'))->groupBy('method')->get()->toArray();
    //     // dd($data);

    //     $lava = new Lavacharts;

    //     $datatable = $lava->DataTable();
    //     $datatable->addStringColumn('Name');
    //     $datatable->addNumberColumn('Donuts Eaten');

    //     foreach ($data as  $value) {
    //         $datatable->addRow([$value['method'], $value['COUNT(id)']]);
    //     }

    //     $pieChart = $lava->PieChart('Donuts', $datatable, [
    //         'width' => 400,
    //         'pieSliceText' => 'value'
    //     ]);

    //     $filter  = $lava->NumberRangeFilter(1, [
    //         'ui' => [
    //             'labelStacking' => 'vertical'
    //         ]
    //     ]);

    //     $control = $lava->ControlWrapper($filter, 'control');
    //     $chart   = $lava->ChartWrapper($pieChart, 'chart');

    //     $lava->Dashboard('Donuts', $datatable)->bind($control, $chart);

    //     return $lava;
    // }
}
