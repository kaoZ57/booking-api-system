<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;
use App\Models\Item;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Store;
use Carbon\Carbon;
use App\Models\Booking_Item;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use App\Models\Status;

class BookingController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        // $dt1 = Carbon::create(2022, 8, 30, 15, 0, 0);
        // $dt2 = Carbon::create(2022, 8, 31, 15, 0, 0);
        // $T = $dt1 > $dt2;
        // return $this->bookingResponse(201, 'successfully', 'booking', $dt1, Response::HTTP_CREATED);
        try {
            $request->validate([
                'booking' => 'required'
            ]);
            $store = Store::find($request->booking['store_id']);
            if (!$store) {
                return $this->bookingResponse(404, 'ไม่มีร้านในระบบ', 'booking', '',  Response::HTTP_NOT_FOUND); //แก้

            }

            foreach ($request->booking['booking_item'] as $value) {
                $item = Item::find($value['item_id']);
                if (!$item) {
                    return $this->bookingResponse(404, 'ไม่มีของในระบบให้จอง', 'booking', '',  Response::HTTP_NOT_FOUND); //แก้
                }
                $amount = $item['amount'] - $value['amount'];
                if ($amount < 0) {
                    return $this->bookingResponse(404, 'ของในระบบไม่พอจอง', 'booking', '',  Response::HTTP_NOT_FOUND); //แก้
                }
            }

            if ($request->booking['start_date'] <  Carbon::now()->setTimezone('Asia/Bangkok') || $request->booking['end_date'] <  Carbon::now()->setTimezone('Asia/Bangkok') || $request->booking['start_date'] > $request->booking['end_date']) {
                return $this->bookingResponse(404, 'คุณจองของเวลาผิด', 'booking', '',  Response::HTTP_NOT_FOUND); //แก้
            }

            $booking = Booking::create([
                'users_id' => Auth::user()->id,
                'store_id' => $request->booking['store_id'],
                'status_id' => 1,
                'start_date' => $request->booking['start_date'],
                'end_date' => $request->booking['end_date'],
                'verify_date' => null,
            ]);

            $booking_itemArr = array();
            foreach ($request->booking['booking_item'] as $value) {
                $booking_item = Booking_Item::create([
                    'booking_id' => $booking['id'],
                    'item_id' => $value['item_id'],
                    'status_id' => 6,
                    'note_user' => $value['note_user'],
                    'note_owner' => '',
                    'amount' => $value['amount'],
                    'updated_by' => 0,
                    'return_date' => null,
                ]);
                array_push($booking_itemArr, $booking_item);
            }

            $response = ([
                'id' => $booking['id'],
                'user_id' => $booking['user_id'],
                'store_id' => $booking['store_id'],
                'status_id' => $booking['status_id'],
                'start_date' => $booking['start_date'],
                'end_date' => $booking['end_date'],
                'verify_date' => $booking['verify_date'],
                'booking_item' => $booking_itemArr,
            ]);

            return $this->bookingResponse(201, 'successfully', 'booking', $response, Response::HTTP_CREATED);
        } catch (QueryException $exception) {
            return $this->bookingResponse(500, (string) $exception->errorInfo[2], 'booking', '', Response::HTTP_UNPROCESSABLE_ENTITY);
        } catch (Exception $exception) {
            Log::critical(': ' . $exception->getTraceAsString());
            return $this->bookingResponse(500, (string) $exception->getMessage(), 'booking', '', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show(Request $request): JsonResponse
    {
        try {

            $booking = Booking::all();

            $bookingArr = array();

            foreach ($booking as $value) {
                $booking_item = Booking_Item::where("booking_id", "=", $value['id'])->get();

                $response = ([
                    'id' => $value['id'],
                    'users_id' => $value['users_id'],
                    'store_id' => $value['store_id'],
                    'status_id' => $value['status_id'],
                    'start_date' => $value['start_date'],
                    'end_date' => $value['end_date'],
                    'verify_date' => $value['verify_date'],
                    'booking_item' => $booking_item,
                ]);
                array_push($bookingArr, $response);
            }
            return $this->bookingResponse(201, "show successfully", 'booking', $bookingArr, Response::HTTP_OK);
        } catch (QueryException $exception) {
            return $this->bookingResponse(500, (string) $exception->errorInfo[2], 'booking', '', Response::HTTP_UNPROCESSABLE_ENTITY);
        } catch (Exception $exception) {
            Log::critical(': ' . $exception->getTraceAsString());
            return $this->bookingResponse(500, (string) $exception->getMessage(), 'booking', '', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update_booking(Request $request): JsonResponse
    {
        try {
            $request->validate([
                'booking' => 'required',
            ]);

            $status = Status::where("table_name", "=", "booking")->get();
            $booking = Booking::find($request->booking['id']);
            if (!$booking) {
                return $this->bookingResponse(404, 'ไม่มีรายการจอง', 'booking', '', Response::HTTP_NOT_FOUND); //แก้
            }
            if ($booking->status_id > 1) {
                return $this->bookingResponse(404, 'แก้ไม่ได้สถานะรอการอนุมัต', 'booking', '', Response::HTTP_NOT_FOUND); //แก้
            }
            if ($request->booking['start_date'] <  Carbon::now()->setTimezone('Asia/Bangkok') || $request->booking['end_date'] <  Carbon::now()->setTimezone('Asia/Bangkok') || $request->booking['start_date'] > $request->booking['end_date']) {
                return $this->bookingResponse(404, 'คุณจองของเวลาผิด', 'booking', '',  Response::HTTP_NOT_FOUND); //แก้
            }
            if ($request->booking['users_id'] != Auth::user()->id) {
                return $this->bookingResponse(404, 'not found', 'booking', '', Response::HTTP_NOT_FOUND); //แก้
            }
            if ($request->booking['status_id'] < 1 || $request->booking['status_id'] > 2) {
                return $this->bookingResponse(404, 'status ไม่ถูกต้อง', 'booking', '', Response::HTTP_NOT_FOUND); //แก้
            }

            $booking->update([
                'start_date' => $request->booking['start_date'],
                'end_date' => $request->booking['end_date'],
                'status_id' => $request->booking['status_id'],
            ]);

            $response = ([
                'start_date' => $booking['start_date'],
                'end_date' => $booking['end_date'],
                'status_id' => $booking['status_id'],
                'status' =>  substr($status[$booking['status_id'] - 1]->name, 4)
            ]);

            return $this->bookingResponse(201, 'update successfully', 'booking', $response, Response::HTTP_CREATED);
        } catch (QueryException $exception) {
            return $this->bookingResponse(500, (string) $exception->errorInfo[2], 'booking', '', Response::HTTP_UNPROCESSABLE_ENTITY);
        } catch (Exception $exception) {
            Log::critical(': ' . $exception->getTraceAsString());
            return $this->bookingResponse(500, (string) $exception->getMessage(), 'booking', '', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function add_items(Request $request)
    {
        try {
            $request->validate([
                'booking_item' => 'required|array',
            ]);

            foreach ($request->booking_item as $value) {
                $booking = Booking::find($value['booking_id']);
                if (!$booking) {
                    return $this->bookingResponse(404, 'ไม่มีใบในระบบให้จอง', 'booking', '',  Response::HTTP_NOT_FOUND); //แก้
                }
                if ($booking['users_id'] != Auth::user()->id) {
                    return $this->bookingResponse(404, 'คุณไม่ใช่เจ้าของใบจอง', 'booking', '', Response::HTTP_NOT_FOUND); //แก้
                }
                $item = Item::find($value['item_id']);
                if (!$item) {
                    return $this->bookingResponse(404, 'ไม่มีของในระบบให้จอง', 'booking', '',  Response::HTTP_NOT_FOUND); //แก้
                }
                $amount = $item['amount'] - $value['amount'];
                if ($amount < 0) {
                    return $this->bookingResponse(404, 'ของในระบบไม่พอจอง', 'booking', '',  Response::HTTP_NOT_FOUND); //แก้
                }
            }

            $booking_itemArr = array();
            foreach ($request->booking_item as $value) {
                $booking_item = Booking_Item::create([
                    'booking_id' => $booking['id'],
                    'item_id' => $value['item_id'],
                    'status_id' => 6,
                    'note_user' => $value['note_user'],
                    'note_owner' => '',
                    'amount' => $value['amount'],
                    'updated_by' => 0,
                    'return_date' => null,
                ]);
                array_push($booking_itemArr, $booking_item);
            }

            return $this->bookingResponse(201, 'add successfully', 'booking_item', $booking_itemArr, Response::HTTP_CREATED); //แก้
        } catch (QueryException $exception) {
            return $this->bookingResponse(500, (string) $exception->errorInfo[2], 'booking_item', '', Response::HTTP_UNPROCESSABLE_ENTITY);
        } catch (Exception $exception) {
            Log::critical(': ' . $exception->getTraceAsString());
            return $this->bookingResponse(500, (string) $exception->getMessage(), 'booking_item', '', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update_bookingitems(Request $request): JsonResponse
    {
        try {
            $request->validate([
                'booking_item' => 'required',
            ]);

            //$status = Status::where();
            $bookingitem = Booking_Item::find($request->booking_id['booking_id']);
            // $booking = Booking::find($request->booking['booking_id']);
            if (!$bookingitem) {
                return $this->bookingResponse(404, 'ไม่มีรายการจอง', 'booking_item', '', Response::HTTP_NOT_FOUND); //แก้
            }

            // if ($request->booking['start_date'] <  Carbon::now()->setTimezone('Asia/Bangkok') || $request->booking['end_date'] <  Carbon::now()->setTimezone('Asia/Bangkok') || $request->booking['start_date'] > $request->booking['end_date']) {
            //     return $this->bookingResponse(404, 'คุณจองของเวลาผิด', 'booking', '',  Response::HTTP_NOT_FOUND); //แก้
            // }
            // if ($request->booking['users_id'] != Auth::user()->id) {
            //     return $this->bookingResponse(404, 'not found', 'booking', '', Response::HTTP_NOT_FOUND); //แก้
            // }

            $bookingitem->update([
                'booking_id' => $request->booking['booking_id '],
                'item_id' => $request->booking['item_id'],
                'note_user' => $request->booking['note_user'],
                'note_owner' => $request->booking['note_owner'],
                'amount' => $request->item['amount'],
            ]);
            return $this->bookingResponse(201, 'update successfully', 'booking_item', $bookingitem, Response::HTTP_CREATED);
        } catch (QueryException $exception) {
            return $this->bookingResponse(500, (string) $exception->errorInfo[2], 'booking_item', '', Response::HTTP_UNPROCESSABLE_ENTITY);
        } catch (Exception $exception) {
            Log::critical(': ' . $exception->getTraceAsString());
            return $this->bookingResponse(500, (string) $exception->getMessage(), 'booking_item', '', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
