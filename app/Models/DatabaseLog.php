<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DatabaseLog extends Model
{
    use HasFactory;

    public $table = 'database_log';
    public $timestamps = false;
    protected $fillable = [
        'event_time',
        'user_id',
        'method',
        'fullUrl',
        'ipAddress',
        'request',
        'message',
        'size_MB'
    ];

    public static function log(Request $request, string $message)
    {
        DatabaseLog::create([
            "event_time" => Carbon::now()->setTimezone('Asia/Bangkok'),
            "user_id" => Auth::user()->id,
            "method" => $request->method(),
            "fullUrl" => $request->fullUrl(),
            "ipAddress" => $request->ip(),
            "request" => $request->collect(),
            "message" => $message,
            "size_MB" => DatabaseLog::sizeDatebase($request)
        ]);
    }

    public static function log_NoUser(Request $request, string $message)
    {
        DatabaseLog::create([
            "event_time" => Carbon::now()->setTimezone('Asia/Bangkok'),
            "user_id" => 0,
            "method" => $request->method(),
            "fullUrl" => $request->fullUrl(),
            "ipAddress" => $request->ip(),
            "request" => $request->collect(),
            "message" => $message,
            "size_MB" => DatabaseLog::sizeDatebase($request)
        ]);
    }

    public static function sizeDatebase(Request $request)
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
    }
}
