<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Central;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\DB;

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
        return 'ไม่มี'; //แก้
      }
      $response = response()->json([
        'response' => [
          'code' => [
            'key' => 201,
            'message' => 'ok', //แก้
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
    $log =  DB::table('mysql.general_log')->where('argument', 'like', "%$response%")->orderBy('event_time', 'DESC')->get();
    return view('dashboard', compact('response', 'log'));
  }

  public function test()
  {
    // return hash_algos();
    // return hash('sha3-256', '2022-02-3');
    // return password_hash('kao', PASSWORD_ARGON2ID);
    // return substr(password_hash('kao', PASSWORD_ARGON2ID), 33);


    // return count($log);
  }
}
