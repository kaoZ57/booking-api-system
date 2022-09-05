<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Stock;
use App\Models\Item;
use App\Models\User;
use App\Http\Controllers\AccessController;
use Illuminate\Database\QueryException;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Log;
use App\Models\DatabaseLog;

class StockController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        try {
            $request->validate([
                'stock' => 'required',
            ]);
            $item = Item::find($request->stock['item_id']);
            if (!$item) {
                DatabaseLog::log($request, 'not found');
                return $this->bookingResponse(404, 'not found', 'stock', '',  Response::HTTP_NOT_FOUND);
            }

            $stock = Stock::create([
                'item_id' => $request->stock['item_id'],
                'amount' => $request->stock['amount'],
            ]);
            $item = Item::find($stock['item_id']);
            $item->update([
                'amount' => $item['amount'] + $stock['amount'],
                'amount_update_at' => Carbon::now()->setTimezone('Asia/Bangkok')->toDateTimeString(),
            ]);

            DatabaseLog::log($request, 'successfully');
            return $this->bookingResponse(101, 'successfully', 'stock', $stock,  Response::HTTP_CREATED);
        } catch (QueryException $exception) {
            DatabaseLog::log($request, (string) $exception->errorInfo[2]);
            return $this->bookingResponse(500, (string) $exception->errorInfo[2], 'stock', '',  Response::HTTP_UNPROCESSABLE_ENTITY);
        } catch (Exception $exception) {
            Log::critical(': ' . $exception->getTraceAsString());
            DatabaseLog::log($request, (string) $exception->getMessage());
            return $this->bookingResponse(500, (string) $exception->getMessage(), 'stock', '',  Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
