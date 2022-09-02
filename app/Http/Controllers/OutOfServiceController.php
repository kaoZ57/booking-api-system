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
                return $this->bookingResponse(404, 'ไม่มีของ', 'out_of_service', '',  Response::HTTP_NOT_FOUND); //แก้
            }
            if ($item['amount'] - $request->out_of_service['amount'] < 0) {

                return $this->bookingResponse(201, 'ไม่สามารถนำมาใช้ได้', 'out_of_service', '',  Response::HTTP_CREATED); //แก้
            }

            $out_of_service = Out_of_service::create([
                'item_id' => $request->out_of_service['item_id'],
                'note' => $request->out_of_service['note'],
                'amount' => $request->out_of_service['amount'],
                'ready_to_use' => $request->out_of_service['ready_to_use'],
                'updated_by' => Auth::user()->id,
            ]);

            $item = Item::find($out_of_service['item_id']);
            $item->update([
                'amount' => $item['amount'] - $out_of_service['amount'],
                'amount_update_at' => Carbon::now()->setTimezone('Asia/Bangkok')->toDateTimeString(),
            ]);

            return $this->bookingResponse(201, 'Out of Service Created successfully', 'out_of_service', $out_of_service,  Response::HTTP_CREATED);
        } catch (QueryException $exception) {
            return $this->bookingResponse(500, (string) $exception->errorInfo[2], 'out_of_service', '',  Response::HTTP_UNPROCESSABLE_ENTITY);
        } catch (Exception $exception) {
            Log::critical(': ' . $exception->getTraceAsString());
            return $this->bookingResponse(500, (string) $exception->getMessage(), 'out_of_service', '',  Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function show(Request $request): JsonResponse
    {
        try {
            $out_of_service = Out_of_service::where("ready_to_use", "=", 0)->get();

            return $this->bookingResponse(201, "show successfully", 'out_of_service', $out_of_service, Response::HTTP_OK);
        } catch (QueryException $exception) {
            return $this->bookingResponse(500, (string) $exception->errorInfo[2], 'out_of_service', '', Response::HTTP_UNPROCESSABLE_ENTITY);
        } catch (Exception $exception) {
            Log::critical(': ' . $exception->getTraceAsString());
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
                return $this->bookingResponse(404, 'ไม่มีรายการ', 'out_of_service', '',  Response::HTTP_NOT_FOUND); //แก้
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

            return $this->bookingResponse(201, 'update successfully', 'out_of_service', $out_of_service, Response::HTTP_OK);
        } catch (QueryException $exception) {
            return $this->bookingResponse(500, (string) $exception->errorInfo[2], 'out_of_service', '', Response::HTTP_UNPROCESSABLE_ENTITY);
        } catch (Exception $exception) {
            Log::critical(': ' . $exception->getTraceAsString());
            return $this->bookingResponse(500, (string) $exception->getMessage(), 'out_of_service', '', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
