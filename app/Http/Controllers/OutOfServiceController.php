<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\JsonResponse;
use App\Models\Item;
use App\Models\Out_of_service;
use App\Models\Store;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use Exception;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\FilterController;
use App\Models\DatabaseLog;

class OutOfServiceController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        try {
            $request->validate([
                'out_of_service' => 'required'
            ]);

            $item = Item::find($request->out_of_service['item_id']);

            if (!$item) {
                DatabaseLog::log($request, 'not found');
                return $this->bookingResponse(404, 'not found', 'out_of_service', '',  Response::HTTP_NOT_FOUND);
            }
            if ($item['amount'] - $request->out_of_service['amount'] < 0) {
                DatabaseLog::log($request, 'invalid amount');
                return $this->bookingResponse(205, 'invalid amount', 'out_of_service', '',  Response::HTTP_CREATED);
            }

            $out_of_service = Out_of_service::create([
                'item_id' => $request->out_of_service['item_id'],
                'note' => $request->out_of_service['note'],
                'amount' => $request->out_of_service['amount'],
                'ready_to_use' => 0,
                'updated_by' => Auth::user()->id,
            ]);

            $item = Item::find($out_of_service['item_id']);
            $item->update([
                'amount' => $item['amount'] - $out_of_service['amount'],
                'amount_update_at' => Carbon::now()->setTimezone('Asia/Bangkok')->toDateTimeString(),
            ]);

            DatabaseLog::log($request, 'successfully');
            return $this->bookingResponse(101, 'successfully', 'out_of_service', $out_of_service,  Response::HTTP_CREATED);
        } catch (QueryException $exception) {
            DatabaseLog::log($request, (string) $exception->errorInfo[2]);
            return $this->bookingResponse(500, (string) $exception->errorInfo[2], 'out_of_service', '',  Response::HTTP_UNPROCESSABLE_ENTITY);
        } catch (Exception $exception) {
            Log::critical(': ' . $exception->getTraceAsString());
            DatabaseLog::log($request, (string) $exception->getMessage());
            return $this->bookingResponse(500, (string) $exception->getMessage(), 'out_of_service', '',  Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function show(Request $request): JsonResponse
    {
        try {
            $out_of_service = FilterController::outOfService_filter($request);

            DatabaseLog::log($request, 'successfully');
            return $this->bookingResponse(101, "successfully", 'out_of_service', $out_of_service, Response::HTTP_OK);
        } catch (QueryException $exception) {
            DatabaseLog::log($request, (string) $exception->errorInfo[2]);
            return $this->bookingResponse(500, (string) $exception->errorInfo[2], 'out_of_service', '', Response::HTTP_UNPROCESSABLE_ENTITY);
        } catch (Exception $exception) {
            Log::critical(': ' . $exception->getTraceAsString());
            DatabaseLog::log($request, (string) $exception->getMessage());
            return $this->bookingResponse(500, (string) $exception->getMessage(), 'out_of_service', '', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function update(Request $request): JsonResponse
    {
        try {
            $request->validate([
                'out_of_service' => 'required',
            ]);
            $out_of_service = Out_of_service::find($request->out_of_service['id']);

            if (!$out_of_service) {
                DatabaseLog::log($request, 'not found');
                return $this->bookingResponse(404, 'not found', 'out_of_service', '',  Response::HTTP_NOT_FOUND);
            }
            if ($out_of_service['ready_to_use'] == 1) {
                DatabaseLog::log($request, 'not found');
                return $this->bookingResponse(404, 'not found', 'out_of_service', '',  Response::HTTP_NOT_FOUND);
            }

            $item = Item::find($out_of_service['item_id']);

            if ($request->out_of_service['ready_to_use'] == 1) {
                $item->update([
                    'amount' => $item['amount'] + $out_of_service['amount'],
                    'amount_update_at' => Carbon::now()->setTimezone('Asia/Bangkok'),
                ]);
            }

            $out_of_service->update([
                'ready_to_use' => $request->out_of_service['ready_to_use'],
                'updated_by' => Auth::user()->id,
            ]);

            DatabaseLog::log($request, 'successfully');
            return $this->bookingResponse(101, 'successfully', 'out_of_service', $out_of_service, Response::HTTP_OK);
        } catch (QueryException $exception) {
            DatabaseLog::log($request, (string) $exception->errorInfo[2]);
            return $this->bookingResponse(500, (string) $exception->errorInfo[2], 'out_of_service', '', Response::HTTP_UNPROCESSABLE_ENTITY);
        } catch (Exception $exception) {
            Log::critical(': ' . $exception->getTraceAsString());
            DatabaseLog::log($request, (string) $exception->getMessage());
            return $this->bookingResponse(500, (string) $exception->getMessage(), 'out_of_service', '', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
