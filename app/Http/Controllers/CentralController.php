<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Central;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Str;

class CentralController extends Controller
{
  public function store(Request $request)
  {

    try {
      if (!Central::where('name', '=', $request['name'])->first()) {
        $migration = $this->migration($request->name);
        if ($migration) {
          return  $migration;
        }
        return response()->json([
          'message' => 'ไม่สำเร็จ'
        ]); //แก้
      }
      return  response()->json([
        'message' => 'มีแล้ว'
      ]); //แก้
    } catch (\Throwable $th) {
      return  $th;
    }
  }

  public function show(Request $request)
  {
    try {
      // change apikey
      // $central = Central::Where('id', '=', 33)->first();
      // $central->update([
      //   'api_key' => hash('crc32c', $plainTextToken = Str::random(39)),
      // ]);
      // return $plainTextToken;
      $central = Central::all();
      $mycentral = Central::Where('api_key', '=', hash('crc32c', $request->header('api_key')))->first();
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
      // return ['database' => DB::getDatabaseName(), 'user' => $user];
      // $bcrypt = hash('crc32c', $plainTextToken = Str::random(39));
      // $key = hash('crc32c', $plainTextToken);
      // return ['$bcrypt' => $bcrypt, '$plainTextToken' => $plainTextToken, '$key' => $key];
    } catch (\Throwable $th) {
      return  $th;
    }
  }
  public function signin(Request $request)
  {
    $response = json_decode($this->store($request)->getContent(), true);
    return redirect()->route('home')->with('response', $response);
  }
  public function test()
  {
    $response = response()->json([
      'id' => 1,
      'name' => 'kao'
    ]);
    $json_decode = json_decode($response->getContent(), true);
    return $json_decode['name'];
  }
}
