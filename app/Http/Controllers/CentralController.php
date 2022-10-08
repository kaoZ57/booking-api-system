<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Central;
use App\Models\DatabaseLog;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Khill\Lavacharts\Lavacharts;
use App\Http\Controllers\Graph\GraphController;
use Illuminate\Support\Facades\Redirect;

class CentralController extends Controller
{
  // public function store(Request $request)
  // {

  //   try {
  //     if (!Central::where('name', '=', $request['name'])->first()) {
  //       $migration = $this->migration($request->name);
  //       if ($migration) {
  //         return  $migration;
  //       }
  //       return response()->json([
  //         'message' => 'ไม่สำเร็จ'
  //       ]); //แก้
  //     }
  //     return  response()->json([
  //       'message' => 'มีแล้ว'
  //     ]); //แก้
  //   } catch (\Throwable $th) {
  //     return  $th;
  //   }
  // }

  public function show(Request $request)
  {
    try {
      $central = Central::all();
      $hashed_password = str_replace(' ', '', strtolower(crypt(crypt(Auth::user()->id, 'CS#13'), 'BooKinGAIpSYsIlovEPhaYUT') . crypt('API' . Auth::user()->id . 'KEY' . Auth::user()->id, 'I LoVe Xkalux') . '|table'));
      $mycentral = Central::Where('api_key', '=', $hashed_password)->first();
      // $mycentral = Central::where("api_key", "=", str_replace(' ', '', strtolower(crypt(crypt(Auth::user()->id, 'CS#13'), 'BooKinGAIpSYsIlovEPhaYUT') . crypt('API' . Auth::user()->id . 'KEY' . Auth::user()->id, 'I LoVe Xkalux') . '|table')))->first();
      $centralJson = array();

      foreach ($central as $value) {
        array_push($centralJson, [
          'id' => $value['id'],
          'name' => $value['name'],
          'created_at' => $value['created_at'],
          'updated_at' => $value['updated_at']
        ]);
      }
      // $centralJson = response()->json([

      if (!$central || !$mycentral) {
        return 'not found';
      }
      $response = response()->json([
        'response' => [
          'code' => [
            'key' => 200,
            'message' => 'ok',
          ],
          'my_central' => $mycentral->name,
          'central' => $centralJson
        ],
        'status' => Response::HTTP_OK
      ], Response::HTTP_OK);

      return $response;
    } catch (\Throwable $th) {
      return  $th;
    }
  }
  public function signin(Request $request)
  {
    $request->validate([
      "name" => 'required'
    ]);

    $hashed_password = str_replace(' ', '', strtolower(crypt(crypt(Auth::user()->id, 'CS#13'), 'BooKinGAIpSYsIlovEPhaYUT') . crypt('API' . Auth::user()->id . 'KEY' . Auth::user()->id, 'I LoVe Xkalux') . '|table'));
    if (!Central::where('api_key', '=', $hashed_password)->first()) {

      $migration = $this->migration($request->name);

      $migration->getContent();

      return redirect('/dashboard');
    }
  }

  public function dashboard()
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

    // $log =  DB::table('database_log')->orderBy('event_time', 'DESC')->get();
    $log =  DB::table('database_log')
      ->join('users', 'users.id', '=', 'database_log.user_id')
      ->orderBy('event_time', 'DESC')
      ->select('database_log.*', 'users.name')
      ->get();

    // temperatures
    $lava = GraphController::temperatures();

    //population
    $lava1 = GraphController::population();

    //rendering
    // $lava2 = GraphController::rendering();

    // $lava = GraphController::all();

    return view('dashboard', compact('response', 'log', 'lava', 'lava1'));
  }

  public function admin_dashboard(Request $request)
  {
    if (Auth::user()->id != 11) {
      CentralController::dashboard();
    } else {
      $response = Central::join('users', 'users.id', '=', 'central.user_id')
        ->select('central.created_at as created_at', 'central.updated_at   as updated_at', 'users.name')
        ->get();
      return view('admindashboard', compact('response'));
    }
  }
}
