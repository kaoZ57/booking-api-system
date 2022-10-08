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
    public static function population()
    {
        $data = DatabaseLog::select(array(DB::raw('DATE(event_time)'), DB::raw('COUNT(*)')))->groupBy(DB::raw('DATE(event_time)'))->get()->toArray();
        $lava = new Lavacharts; // See note below for Laravel

        $population = $lava->DataTable();

        $population->addDateColumn('Year')
            ->addNumberColumn('Record');

        foreach ($data as  $value) {
            $population->addRow([$value['DATE(event_time)'], $value['COUNT(*)']]);
            // ->addRow(['2014-1
        }

        $lava->AreaChart('Population', $population, [
            'title' => 'Number of Record Usage Data',
            'legend' => [
                'position' => 'in'
            ]
        ]);

        return $lava;

        // return view('larachart', compact('lava'));
    }

    public static function temperatures()
    {
        $data = DatabaseLog::select('event_time', 'size_MB')->get()->toArray();
        // dd($data);

        $lava = new Lavacharts; // See note below for Laravel

        $temperatures = $lava->DataTable();

        $temperatures->addDateColumn('Date')
            ->addNumberColumn('size(MB)');
        // ->addRow(['2014-10-1',  67, 65, 62]);

        foreach ($data as  $value) {
            $temperatures->addRow([$value['event_time'], $value['size_MB']]);
            // ->addRow(['2014-1
        }

        $lava->LineChart('Temps', $temperatures, [
            'title' => 'dat size'
        ]);

        return $lava;
        // return view('larachart', compact('lava'));
    }

    public static function rendering()
    {

        //pieChart
        $data = DatabaseLog::select(array(DB::raw('COUNT(id)'), 'method'))->groupBy('method')->get()->toArray();
        // dd($data);

        $lava = new Lavacharts;

        $datatable = $lava->DataTable();
        $datatable->addStringColumn('Name');
        $datatable->addNumberColumn('Method Donuts Eaten');

        foreach ($data as  $value) {
            $datatable->addRow([$value['method'], $value['COUNT(id)']]);
        }

        $pieChart = $lava->PieChart('Donuts', $datatable, [
            'width' => 400,
            'pieSliceText' => 'value'
        ]);

        $filter  = $lava->NumberRangeFilter(1, [
            'ui' => [
                'labelStacking' => 'vertical'
            ]
        ]);

        $control = $lava->ControlWrapper($filter, 'control');
        $chart   = $lava->ChartWrapper($pieChart, 'chart');

        $lava->Dashboard('Donuts', $datatable)->bind($control, $chart);

        return $lava;
    }

    public static function all()
    {
        $data = DatabaseLog::select(array(DB::raw('COUNT(id)'), 'method'))->groupBy('method')->get()->toArray();
        $lava = new Lavacharts;

        $datatable = $lava->DataTable();
        $datatable->addStringColumn('Name');
        $datatable->addNumberColumn('Method Donuts Eaten');

        foreach ($data as  $value) {
            $datatable->addRow([$value['method'], $value['COUNT(id)']]);
        }

        $pieChart = $lava->PieChart('Donuts', $datatable, [
            'width' => 400,
            'pieSliceText' => 'value'
        ]);

        $filter  = $lava->NumberRangeFilter(1, [
            'ui' => [
                'labelStacking' => 'vertical'
            ]
        ]);

        $control = $lava->ControlWrapper($filter, 'control');
        $chart   = $lava->ChartWrapper($pieChart, 'chart');

        $lava->Dashboard('Donuts', $datatable)->bind($control, $chart);

        $data1 = DatabaseLog::select('event_time', 'size_MB')->get()->toArray();
        $temperatures = $lava->DataTable();

        $temperatures->addDateColumn('Date')
            ->addNumberColumn('size(MB)');
        // ->addRow(['2014-10-1',  67, 65, 62]);

        foreach ($data1 as  $value) {
            $temperatures->addRow([$value['event_time'], $value['size_MB']]);
            // ->addRow(['2014-1
        }

        $lava->LineChart('Temps', $temperatures, [
            'title' => 'dat size'
        ]);

        $data2 = DatabaseLog::select(array(DB::raw('DATE(event_time)'), DB::raw('COUNT(*)')))->groupBy(DB::raw('DATE(event_time)'))->get()->toArray();
        $population = $lava->DataTable();

        $population->addDateColumn('Year')
            ->addNumberColumn('Record');

        foreach ($data2 as  $value) {
            $population->addRow([$value['DATE(event_time)'], $value['COUNT(*)']]);
            // ->addRow(['2014-1
        }

        $lava->AreaChart('Population', $population, [
            'title' => 'Number of Record Usage Data',
            'legend' => [
                'position' => 'in'
            ]
        ]);

        return $lava;
    }
}
