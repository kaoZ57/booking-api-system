<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Database\QueryException;
use Exception;
use Illuminate\Support\Facades\Log;
use App\Models\Item;
use App\Models\User;
use App\Models\Store;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ItemController extends Controller
{
    public function test_timestamp(Request $request)
    {
        $request->validate([
            'timestamp' => 'required'
        ]);
        $timestamp = $request['timestamp'];
        return $timestamp;
    }
    public function store(Request $request): JsonResponse
    {
        try {
            $request->validate([
                'item' => 'required'
            ]);
            $item = Item::create([
                'name' => $request->item['name'],
                'description' => $request->item['description'],
                'store_id' => $request->item['store_id'],
                'amount' => 0,
                'is_active' => $request->item['is_active'],
                'is_not_return' => $request->item['is_not_return'],
                'updated_by' => Auth::user()->id,
                'amount_update_at' => Carbon::now()->setTimezone('Asia/Bangkok'),
            ]);

            $result = [
                'id' => $item['id'],
                'name' => $item['name'],
                'description' => $item['description'],
                'store_id' => $item['store_id'],
                'amount' => $item['amount'],
                'is_active' => $item['is_active'],
                'is_not_return' => $item['is_not_return'],
                'updated_by' => $item['updated_by'],
                'amount_update_at' => $item['amount_update_at'],
                'updated_by_name' => User::find($item['updated_by'])->name,
            ];

            return $this->bookingResponse(201, 'successfully', 'item', $result, Response::HTTP_CREATED);
        } catch (QueryException $exception) {
            return $this->bookingResponse(500, (string) $exception->errorInfo[2], 'item', '', Response::HTTP_UNPROCESSABLE_ENTITY);
        } catch (Exception $exception) {
            Log::critical(': ' . $exception->getTraceAsString());
            return $this->bookingResponse(500, (string) $exception->getMessage(), 'item', '', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function show(Request $request): JsonResponse
    {
        try {
            if ($request->filter) {
                if ($request->filter['item_id']) {
                    $items = DB::table('item')
                        ->where("id", "=", $request->filter['item_id'])
                        ->get();
                    return $this->bookingResponse(201, 'successful', 'item', $items, Response::HTTP_OK);
                }
            }
            // if ($request->filter['tag_id']) {
            //     $items = DB::table('item')->where("id", "=", $request->filter['tag_id'])->get();
            //     return $this->bookingResponse(201, 'successful', 'item', $items, Response::HTTP_OK);
            // }
            $items = DB::select("select * from item");
            return $this->bookingResponse(201, 'successful', 'item', $items, Response::HTTP_OK);
        } catch (QueryException $exception) {
            return $this->bookingResponse(500, (string) $exception->errorInfo[2], 'item', '', Response::HTTP_UNPROCESSABLE_ENTITY);
        } catch (Exception $exception) {
            Log::critical(': ' . $exception->getTraceAsString());
            return $this->bookingResponse(500, (string) $exception->getMessage(), 'item', '', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(Request $request): JsonResponse
    {
        $request->validate([
            'item' => 'required'
        ]);

        $item = Item::find($request->item['id']);

        try {
            $request->validate([
                'item' => 'required'
            ]);

            $item = Item::find($request->item['id']);
            if (!$item) {
                return $this->bookingResponse(404, 'ไม่มีของ', 'item', '',  Response::HTTP_NOT_FOUND); //แก้
            }

            $item->update([
                'name' => $request->item['name'],
                'description' => $request->item['description'],
                'is_active' => $request->item['is_active'],
                'is_not_return' => $request->item['is_not_return']
            ]);
            return $this->bookingResponse(201, 'successful', 'item', $item, Response::HTTP_OK);
        } catch (QueryException $exception) {
            return $this->commonResponse(500, (string) $exception->errorInfo[2], 'item', '', Response::HTTP_UNPROCESSABLE_ENTITY);
        } catch (Exception $exception) {
            Log::critical(': ' . $exception->getTraceAsString());
            return $this->commonResponse(500, (string) $exception->getMessage(), 'item', '', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
