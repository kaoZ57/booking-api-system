<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Central;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Manage
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public  function handle(Request $request, Closure $next)
    {
        if (!$request->header('api_key')) {
            return response()->json([
                'response' => 'no api key',
            ]);
        }
        // $central = Central::Where('api_key', '=', hash('crc32c', $request->header('api_key')))->first();
        // if (!$central) {
        //     return response()->json([
        //         'response' => 'no api key',
        //     ]);
        // }

        DB::connection('mysql');
        config(['database.connections.mysql.database' => $request->header('api_key')]);
        DB::purge('mysql');
        DB::reconnect('mysql');
        return $next($request);

        // config(['database.connections.mysql.database' => $request->header('api_key')]);
        // DB::purge('mysql');
        // DB::reconnect('mysql');
        // return $next($request);
    }
}
