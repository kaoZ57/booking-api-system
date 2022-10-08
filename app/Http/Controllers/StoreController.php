<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\Store;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;
use Exception;
use App\Models\DatabaseLog;

class StoreController extends Controller
{
    public function show(Request $request): JsonResponse
    {
        try {
            $stores = Store::all();

            DatabaseLog::log($request, "successfully");
            return $this->bookingResponse(101, "successfully", 'store', $stores, Response::HTTP_OK);
        } catch (QueryException $exception) {
            DatabaseLog::log($request, (string) $exception->errorInfo[2]);
            return $this->bookingResponse(500, (string) $exception->errorInfo[2], 'store', '', Response::HTTP_UNPROCESSABLE_ENTITY);
        } catch (Exception $exception) {
            Log::critical(': ' . $exception->getTraceAsString());
            DatabaseLog::log($request, (string) $exception->getMessage());
            return $this->bookingResponse(500, (string) $exception->getMessage(), 'store', '', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(Request $request): JsonResponse
    {
        try {
            $request->validate([
                'store' => 'required',
            ]);

            $store = Store::find($request->store['id']);
            if (!$store) {
                DatabaseLog::log($request, "not found");
                return $this->bookingResponse(404, 'not found', 'store', $store, Response::HTTP_NOT_FOUND);
            };

            $store->update([
                'id' => $request->store['id'],
                'name' => $request->store['name'],
                'is_active' => $request->store['is_active'],
            ]);
            $store = Store::find($request->store['id']);

            DatabaseLog::log($request, "successfully");
            return $this->bookingResponse(101, 'successfully', 'store', $store, Response::HTTP_OK);
        } catch (QueryException $exception) {
            DatabaseLog::log($request, (string) $exception->errorInfo[2]);
            return $this->bookingResponse(500, (string) $exception->errorInfo[2], 'store', '', Response::HTTP_UNPROCESSABLE_ENTITY);
        } catch (Exception $exception) {
            Log::critical(': ' . $exception->getTraceAsString());
            DatabaseLog::log($request, (string) $exception->getMessage());
            return $this->bookingResponse(500, (string) $exception->getMessage(), 'store', '', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
