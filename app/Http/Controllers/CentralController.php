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

  public function index()
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

    $log =  DB::table('database_log')->orderBy('event_time', 'DESC')->get();

    return view('dashboard', compact('response', 'log'));
  }

  public function test(Request $request)
  {
    $api_key = strtolower($request->header('api_key'));

    $data = DB::table('information_schema.TABLES')
      ->where('table_schema', '=',  $api_key)
      ->select('table_schema AS Database', 'data_length AS data_length', 'index_length AS index_length')
      ->get();

    $data_length = 0;
    $index_length = 0;
    foreach ($data as $value) {
      $data_length += $value->data_length;
    }
    foreach ($data as $value) {
      $index_length += $value->index_length;
    }
    $size = round(($data_length + $index_length) / 1024 / 1024, 2);
    return $size;

    // DB::connection('mysql');
    // config(['database.connections.mysql.database' => $request->header('api_key')]);
    // DB::purge('mysql');
    // DB::reconnect('mysql');
    // return DatabaseLog::all();
    $response = ([
      "event_time" => Carbon::now()->setTimezone('Asia/Bangkok'),
      "user_id" => 1,
      "method" => $request->method(),
      "fullUrl" => $request->fullUrl(),
      "ipAddress" => $request->ip(),
      "request" => $request->collect(),
      "message" => "successfully",

      // "collect" => $request->collect()
    ]);

    return $response;
    // return hash_algos();
    // return hash('sha256', '2022-02-3');
    // return password_hash("rasmuslerdorf", PASSWORD_BCRYPT, ['memory_cost' => 2048, 'time_cost' => 4, 'threads' => 3]);
    // return password_hash('kao', PASSWORD_ARGON2ID);
    // return substr(password_hash('kao', PASSWORD_ARGON2ID), 33);


    // return count($log);
  }
}
