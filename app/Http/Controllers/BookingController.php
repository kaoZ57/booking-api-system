<?php

namespace App\Http\Controllers;

use Exception;
use Carbon\Carbon;
use App\Models\Item;
use App\Models\User;
use App\Models\Store;
use App\Models\Status;
use App\Models\Booking;
use App\Models\Booking_Item;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use PhpParser\Node\Stmt\Foreach_;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

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
                'user_id' => $booking['users_id'],
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
            $booking = Booking::where('created_at', '<', Carbon::now()->setTimezone('Asia/Bangkok'));
            if ($request->has('users_id')) {
                $booking->where('users_id', "=", $request->users_id);
            }
            if ($request->has('start_date')) {
                $booking->where('start_date', ">=", $request->start_date);
            }
            if ($request->has('end_date')) {
                $booking->where('end_date', "<=", $request->end_date);
            }
            if ($request->has('booking_id')) {
                $booking->where('id', "=", $request->booking_id);
            }
            if ($request->has('status')) {
                if ($request->status == "prepairing") {

                    $booking->where('status_id', "=", Status::where("name", "like", "101%")->first()->id);
                }
                if ($request->status == "pending") {
                    $booking->where('status_id', "=", Status::where("name", "like", "102%")->first()->id);
                }
                if ($request->status == "approve") {
                    $booking->where('status_id', "=", Status::where("name", "like", "103%")->first()->id);
                }
                if ($request->status == "complete") {
                    $booking->where('status_id', "=", Status::where("name", "like", "104%")->first()->id);
                }
            }

            $response = array();

            foreach ($booking->get() as $value) {

                $booking_item = Booking_Item::where("booking_id", "=", $value['id'])->get();
                $booking_itemArr = array();
                foreach ($booking_item as $value1) {
                    $booking_itemResponse = ([
                        'id' => $value1['id'],
                        'booking_id' => $value1['booking_id'],
                        'item_id' => $value1['item_id'],
                        'status_id' => $value1['status_id'],
                        'status' =>  substr(Status::find($value1['status_id'])->name, 4),
                        'note_user' => $value1['note_user'],
                        'note_owner' => $value1['note_owner'],
                        'amount' => $value1['amount'],
                        'updated_by' => $value1['updated_by'],
                        'return_date' => $value1['return_date'],
                        'created_at' => $value1['created_at'],
                        'updated_at' => $value1['updated_at'],
                    ]);
                    array_push($booking_itemArr, $booking_itemResponse);
                }

                $bookingArr = ([
                    'id' => $value['id'],
                    'users_id' => $value['users_id'],
                    'store_id' => $value['store_id'],
                    'status_id' => $value['status_id'],
                    'status' =>  substr(Status::find($value['status_id'])->name, 4),
                    'start_date' => $value['start_date'],
                    'end_date' => $value['end_date'],
                    'verify_date' => $value['verify_date'],
                    'created_at' => $value['created_at'],
                    'updated_at' => $value['updated_at'],
                    'booking_item' => $booking_itemArr,
                ]);
                array_push($response, $bookingArr);
            }
            return $this->bookingResponse(201, "show successfully", 'booking', $response, Response::HTTP_OK);
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
            if ($booking->status_id != 1) {
                return $this->bookingResponse(404, 'แก้ไม่ได้สถานะรอการอนุมัต', 'booking', '', Response::HTTP_NOT_FOUND); //แก้
            }
            if ($request->booking['start_date'] <  Carbon::now()->setTimezone('Asia/Bangkok') || $request->booking['end_date'] <  Carbon::now()->setTimezone('Asia/Bangkok') || $request->booking['start_date'] > $request->booking['end_date']) {
                return $this->bookingResponse(404, 'คุณจองของเวลาผิด', 'booking', '',  Response::HTTP_NOT_FOUND); //แก้
            }
            if ($booking['users_id'] != Auth::user()->id) {
                return $this->bookingResponse(404, 'คุณไม่ใช่เจ้าของ', 'booking', '', Response::HTTP_NOT_FOUND); //แก้
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
                if ($booking['status_id'] != 1) {
                    return $this->bookingResponse(404, 'แก้ไม่ได้สถานะรอการอนุมัต', 'booking', '',  Response::HTTP_NOT_FOUND); //แก้
                }
                if ($booking['status_id'] < 1 || $booking['status_id'] > 2) {
                    return $this->bookingResponse(404, 'status ไม่ถูกต้อง', 'booking', '', Response::HTTP_NOT_FOUND); //แก้
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

    public function update_items_by_customer(Request $request): JsonResponse
    {
        try {
            $request->validate([
                'booking_item' => 'required',
            ]);

            $response = array();

            foreach ($request->booking_item as $value) {

                $booking_item = Booking_Item::find($value['id']);

                $booking = Booking::find($booking_item['booking_id']);
                if ($booking['status_id'] == 1) {
                    return $this->bookingResponse(404, 'แก้ไขไม่ได้การจองนี้ถูกปฏิเสธ', 'booking', '', Response::HTTP_NOT_FOUND); //แก้
                }
                if ($booking['status_id'] == 2) {
                    return $this->bookingResponse(404, 'คุณยืนยันการจองไปแล้ว', 'booking', '', Response::HTTP_NOT_FOUND); //แก้
                }
                if ($booking['status_id'] == 4) {
                    return $this->bookingResponse(404, 'การจองนี้เสร็จสิ้นแล้วไม่สามารถแก้ไข้ได้', 'booking', '', Response::HTTP_NOT_FOUND); //แก้
                }
                if (!$booking_item) {
                    return $this->bookingResponse(404, 'ไม่มีรายการจอง', 'booking_item', '', Response::HTTP_NOT_FOUND); //แก้
                }
                if ($booking['users_id'] != Auth::user()->id) {
                    return $this->bookingResponse(404, 'คุณไม่ใช่เจ้าของใบจอง', 'booking', '', Response::HTTP_NOT_FOUND); //แก้
                }
                if ($booking_item['amount'] < 1) {
                    return $this->bookingResponse(404, 'คุณไม่ได้ใส่จำนวนจอง', 'booking_item', '', Response::HTTP_NOT_FOUND); //แก้
                }


                $booking_item->update([
                    'note_user' => $value['note_user'],
                    'amount' => $value['amount'],
                ]);

                array_push($response, $booking_item);
            }
            return $this->bookingResponse(201, 'update successfully', 'booking_item', $response, Response::HTTP_CREATED);
        } catch (QueryException $exception) {
            return $this->bookingResponse(500, (string) $exception->errorInfo[2], 'booking_item', '', Response::HTTP_UNPROCESSABLE_ENTITY);
        } catch (Exception $exception) {
            Log::critical(': ' . $exception->getTraceAsString());
            return $this->bookingResponse(500, (string) $exception->getMessage(), 'booking_item', '', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function update_items_by_staff(Request $request): JsonResponse
    {
        try {
            $request->validate([
                'booking_item' => 'required',
            ]);

            $statusBooking_item = Status::where("table_name", "=", "booking_item")->get();
            foreach ($request->booking_item as $value) {
                if (!$statusBooking_item->find($value['status_id'])) {
                    return $this->bookingResponse(404, 'status ไม่ถูกต้อง', 'booking_item', '', Response::HTTP_NOT_FOUND); //แก้
                }
            }

            $response = array();
            $status = array();

            foreach ($request->booking_item as $value) {
                $booking_item = Booking_Item::find($value['id']);

                $booking = Booking::find($booking_item['booking_id']);
                if (!$booking) {
                    return $this->bookingResponse(404, 'ไม่มีรายการจอง', 'booking', '', Response::HTTP_NOT_FOUND); //แก้
                }
                if ($booking['status_id'] == 1) {
                    return $this->bookingResponse(404, 'เจ้าของยังไม่ได้ยืนยันการจอง', 'booking', '', Response::HTTP_NOT_FOUND); //แก้
                }
                if ($booking['status_id'] == 4) {
                    return $this->bookingResponse(404, 'การจองนี้เสร็จสิ้นแล้วไม่สามารถแก้ไข้ได้', 'booking', '', Response::HTTP_NOT_FOUND); //แก้
                }
                if (!$booking_item) {
                    return $this->bookingResponse(404, 'ไม่มีรายการของที่จอง', 'booking_item', '', Response::HTTP_NOT_FOUND); //แก้
                }

                $booking_item->update([
                    'status_id' => $value['status_id'],
                    'note_owner' => $value['note_owner'],
                    'updated_by' => Auth::user()->id,
                ]);
                array_push($response, $booking_item);
                array_push($status, $value['status_id']);
            }

            //เช็คหาสถานพทั้งหมดว่าเหมือนกันไหม
            foreach ($status as $value) {
                if ($status[0] != $value) {
                    $isStatus = false;
                    break;
                }
                $isStatus = true;
            }

            if ($isStatus) {
                if ($status[0] == 5) {
                    $booking->update(['status_id' => 4]);
                }
                if ($status[0] == 6) {
                    $booking->update(['status_id' => 2]);
                }
                if ($status[0] == 7) {
                    $booking_return = Booking_Item::where("booking_id", "=", $booking['id'])->get();
                    foreach ($booking_return as $value) {
                        $item_data = Item::find($value['item_id']);
                        $amount = $item_data['amount'] - $value['amount'];
                        if ($amount < 0) {
                            return $this->bookingResponse(404, 'ไม่มีของให้จอง', 'booking_item', '', Response::HTTP_NOT_FOUND);
                        }
                        $item_data->update(['amount' => $amount]);
                    }

                    foreach ($booking_return as $value) {
                        $item_data = Item::find($value['item_id']);
                        if ($item_data['is_not_return'] == 1) {
                            $value->update(['status_id' => 9, 'return_date' => Carbon::now()->setTimezone('Asia/Bangkok')]);
                        }
                    }
                    $booking->update(['status_id' => 3, 'verify_date' => Carbon::now()->setTimezone('Asia/Bangkok')]);
                }
                if ($status[0] == 8) {
                    $booking->update(['status_id' => 3]);
                }
                if ($status[0] == 9) {
                    $booking->update(['status_id' => 4]);
                    $booking_return = Booking_Item::where("booking_id", "=", $booking['id'])->get();
                    foreach ($booking_return as $value) {
                        $value->update(['return_date' => Carbon::now()->setTimezone('Asia/Bangkok')]);
                    }
                    foreach ($booking_return as $value) {
                        $item_data = Item::find($value['item_id']);
                        $item_data->update(['amount' => $item_data['amount'] + $value['amount']]);
                    }
                }
            }
            return $this->bookingResponse(201, 'update successfully', 'booking_item', $response, Response::HTTP_CREATED);
        } catch (QueryException $exception) {
            return $this->bookingResponse(500, (string) $exception->errorInfo[2], 'booking_item', '', Response::HTTP_UNPROCESSABLE_ENTITY);
        } catch (Exception $exception) {
            Log::critical(': ' . $exception->getTraceAsString());
            return $this->bookingResponse(500, (string) $exception->getMessage(), 'booking_item', '', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
