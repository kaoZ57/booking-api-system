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
use App\Http\Controllers\FilterController;
use App\Models\DatabaseLog;

class BookingController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        // $dt1 = Carbon::create(2022, 8, 30, 15, 0, 0);
        // $dt2 = Carbon::create(2022, 8, 31, 15, 0, 0);
        // $T = $dt1 > $dt2;
        // return $this->bookingResponse(100, 'successfully', 'booking', $dt1, Response::HTTP_CREATED);
        try {
            $request->validate([
                'booking' => 'required'
            ]);
            $store = Store::find($request->booking['store_id']);
            if (!$store) {
                DatabaseLog::log($request, 'not found');
                return $this->bookingResponse(404, 'not found', 'booking', '',  Response::HTTP_NOT_FOUND);
            }

            foreach ($request->booking['booking_item'] as $value) {
                $item = Item::find($value['item_id']);
                if (!$item) {
                    DatabaseLog::log($request, 'item out of stock');
                    return $this->bookingResponse(201, 'item out of stock', 'booking', '',  Response::HTTP_NOT_FOUND);
                }
                if ($item['is_active'] == 0) {
                    DatabaseLog::log($request, 'can not booking');
                    return $this->bookingResponse(216, 'can not booking,' . $item['name'] . 'this item not open to booking', 'booking', '',  Response::HTTP_NOT_FOUND);
                }
                $amount = $item['amount'] - $value['amount'];
                if ($amount < 0) {
                    DatabaseLog::log($request, 'not enough item');
                    return $this->bookingResponse(202, 'not enough item', 'booking', '',  Response::HTTP_NOT_FOUND);
                }
            }

            if ($request->booking['start_date'] <  Carbon::now()->setTimezone('Asia/Bangkok') || $request->booking['end_date'] <  Carbon::now()->setTimezone('Asia/Bangkok') || $request->booking['start_date'] > $request->booking['end_date']) {
                DatabaseLog::log($request, 'invalid date');
                return $this->bookingResponse(203, 'invalid date', 'booking', '',  Response::HTTP_NOT_FOUND);
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

            DatabaseLog::log($request, 'successfully');
            return $this->bookingResponse(101, 'successfully', 'booking', $response, Response::HTTP_CREATED);
        } catch (QueryException $exception) {
            DatabaseLog::log($request, (string) $exception->errorInfo[2]);
            return $this->bookingResponse(500, (string) $exception->errorInfo[2], 'booking', '', Response::HTTP_UNPROCESSABLE_ENTITY);
        } catch (Exception $exception) {
            Log::critical(': ' . $exception->getTraceAsString());
            DatabaseLog::log($request, (string) $exception->getMessage());
            return $this->bookingResponse(500, (string) $exception->getMessage(), 'booking', '', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show(Request $request): JsonResponse
    {
        try {
            $booking = FilterController::booking_filter($request);

            $response = array();

            foreach ($booking as $value) {

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

            DatabaseLog::log($request, 'successfully');
            return $this->bookingResponse(101, "successfully", 'booking', $response, Response::HTTP_OK);
        } catch (QueryException $exception) {
            DatabaseLog::log($request, (string) $exception->errorInfo[2]);
            return $this->bookingResponse(500, (string) $exception->errorInfo[2], 'booking', '', Response::HTTP_UNPROCESSABLE_ENTITY);
        } catch (Exception $exception) {
            Log::critical(': ' . $exception->getTraceAsString());
            DatabaseLog::log($request, (string) $exception->getMessage());
            return $this->bookingResponse(500, (string) $exception->getMessage(), 'booking', '', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update_booking(Request $request): JsonResponse
    {
        try {
            $request->validate([
                'booking' => 'required',
            ]);

            $booking = Booking::find($request->booking['id']);
            $status = Status::where("table_name", "=", "booking")->where("id", "=", $booking['status_id'])->first();

            if (!$booking) {
                DatabaseLog::log($request, 'not found');
                return $this->bookingResponse(404, 'not found', 'booking', '', Response::HTTP_NOT_FOUND);
            }
            if ($booking->status_id != 1) {
                DatabaseLog::log($request, 'can not edit, booking is ' . substr($status['name'], 4) . ' status');
                return $this->bookingResponse(212, 'can not edit, booking is ' . substr($status['name'], 4) . ' status', 'booking', '', Response::HTTP_NOT_FOUND);
            }
            if ($request->booking['end_date'] <  Carbon::now()->setTimezone('Asia/Bangkok') || $request->booking['start_date'] > $request->booking['end_date']) {
                DatabaseLog::log($request, 'invalid date');
                return $this->bookingResponse(203, 'invalid date', 'booking', '',  Response::HTTP_NOT_FOUND);
            }
            // if ($request->booking['start_date'] <  Carbon::now()->setTimezone('Asia/Bangkok') || $request->booking['end_date'] <  Carbon::now()->setTimezone('Asia/Bangkok') || $request->booking['start_date'] > $request->booking['end_date']) {
            //     DatabaseLog::log($request, 'invalid date');
            //     return $this->bookingResponse(203, 'invalid date', 'booking', '',  Response::HTTP_NOT_FOUND);
            // }
            if ($booking['users_id'] != Auth::user()->id) {
                DatabaseLog::log($request, 'you are not owner');
                return $this->bookingResponse(207, 'you are not owner', 'booking', '', Response::HTTP_NOT_FOUND);
            }
            if ($request->booking['status_id'] < 1 || $request->booking['status_id'] > 2) {
                DatabaseLog::log($request, 'invalid status');
                return $this->bookingResponse(204, 'invalid status', 'booking', '', Response::HTTP_NOT_FOUND);
            }

            $booking->update([
                'start_date' => $request->booking['start_date'],
                'end_date' => $request->booking['end_date'],
                'status_id' => $request->booking['status_id'],
            ]);

            // $response = ([
            //     'start_date' => $booking['start_date'],
            //     'end_date' => $booking['end_date'],
            //     'status_id' => $booking['status_id'],
            //      'status' =>  substr(Status::find($booking['status_id'])->name, 4)
            // ]);

            DatabaseLog::log($request, 'successfully');
            return $this->bookingResponse(101, 'successfully', 'booking', $booking, Response::HTTP_CREATED);
        } catch (QueryException $exception) {
            DatabaseLog::log($request, (string) $exception->errorInfo[2]);
            return $this->bookingResponse(500, (string) $exception->errorInfo[2], 'booking', '', Response::HTTP_UNPROCESSABLE_ENTITY);
        } catch (Exception $exception) {
            Log::critical(': ' . $exception->getTraceAsString());
            DatabaseLog::log($request, (string) $exception->getMessage());
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
                $booking_item = Booking_Item::where('item_id', '=', $value['item_id'])->where('booking_id', '=', $value['booking_id'])->first();
                // return $this->bookingResponse(777, '77', '777', $booking_item,  Response::HTTP_NOT_FOUND);
                if ($booking_item) {
                    DatabaseLog::log($request, 'item is duplicate');
                    return $this->bookingResponse(204, 'item is duplicate', 'booking', '',  Response::HTTP_NOT_FOUND);
                }
                if (!$booking) {
                    DatabaseLog::log($request, 'not found');
                    return $this->bookingResponse(404, 'not found', 'booking', '',  Response::HTTP_NOT_FOUND);
                }
                if ($booking['users_id'] != Auth::user()->id) {
                    DatabaseLog::log($request, 'you are not owner');
                    return $this->bookingResponse(207, 'you are not owner', 'booking', '', Response::HTTP_NOT_FOUND);
                }
                if ($booking['status_id'] != 1) {
                    DatabaseLog::log($request, 'can not edit, booking is pending status');
                    return $this->bookingResponse(212, 'can not edit, booking is pending status', 'booking', '',  Response::HTTP_NOT_FOUND);
                }
                if ($booking['status_id'] < 1 || $booking['status_id'] > 2) {
                    DatabaseLog::log($request, 'invalid status');
                    return $this->bookingResponse(204, 'invalid status', 'booking', '', Response::HTTP_NOT_FOUND);
                }
                $item = Item::find($value['item_id']);
                if (!$item) {
                    DatabaseLog::log($request, 'not found');
                    return $this->bookingResponse(404, 'not found', 'booking', '',  Response::HTTP_NOT_FOUND);
                }
                $amount = $item['amount'] - $value['amount'];
                if ($amount < 0) {
                    DatabaseLog::log($request, 'not enough item', 'booking');
                    return $this->bookingResponse(202, 'not enough item', 'booking', '',  Response::HTTP_NOT_FOUND);
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

            DatabaseLog::log($request, 'successfully');
            return $this->bookingResponse(101, 'successfully', 'booking_item', $booking_itemArr, Response::HTTP_CREATED);
        } catch (QueryException $exception) {
            DatabaseLog::log($request, (string) $exception->errorInfo[2]);
            return $this->bookingResponse(500, (string) $exception->errorInfo[2], 'booking_item', '', Response::HTTP_UNPROCESSABLE_ENTITY);
        } catch (Exception $exception) {
            Log::critical(': ' . $exception->getTraceAsString());
            DatabaseLog::log($request, (string) $exception->getMessage());
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
                if ($booking['status_id'] == 2) {
                    DatabaseLog::log($request, 'can not edit, you are already confirm booking');
                    return $this->bookingResponse(214, 'can not edit, you are already confirm booking', 'booking', '', Response::HTTP_NOT_FOUND);
                }
                if ($booking['status_id'] == 3) {
                    DatabaseLog::log($request, 'can not edit, booking is approve');
                    return $this->bookingResponse(215, 'can not edit, booking is approve', 'booking', '', Response::HTTP_NOT_FOUND);
                }
                if ($booking['status_id'] == 4) {
                    DatabaseLog::log($request, 'can not edit,booking is completed');
                    return $this->bookingResponse(215, 'can not edit,booking is completed', 'booking', '', Response::HTTP_NOT_FOUND);
                }
                if (!$booking_item) {
                    DatabaseLog::log($request, 'not found');
                    return $this->bookingResponse(404, 'not found', 'booking_item', '', Response::HTTP_NOT_FOUND);
                }
                if ($booking['users_id'] != Auth::user()->id) {
                    DatabaseLog::log($request, 'you are not owner');
                    return $this->bookingResponse(207, 'you are not owner', 'booking', '', Response::HTTP_NOT_FOUND);
                }
                if ($booking_item['amount'] < 1) {
                    DatabaseLog::log($request, "you don't fill amount");
                    return $this->bookingResponse(208, "you don't fill amount", 'booking_item', '', Response::HTTP_NOT_FOUND);
                }


                $booking_item->update([
                    'note_user' => $value['note_user'],
                    'amount' => $value['amount'],
                ]);

                array_push($response, $booking_item);
            }

            DatabaseLog::log($request, 'successfully');
            return $this->bookingResponse(101, 'successfully', 'booking_item', $response, Response::HTTP_CREATED);
        } catch (QueryException $exception) {
            DatabaseLog::log($request, (string) $exception->errorInfo[2]);
            return $this->bookingResponse(500, (string) $exception->errorInfo[2], 'booking_item', '', Response::HTTP_UNPROCESSABLE_ENTITY);
        } catch (Exception $exception) {
            Log::critical(': ' . $exception->getTraceAsString());
            DatabaseLog::log($request, (string) $exception->getMessage());
            return $this->bookingResponse(500, (string) $exception->getMessage(), 'booking_item', '', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function update_items_by_staff(Request $request): JsonResponse
    {
        try {
            $request->validate([
                'booking_item' => 'required',
            ]);

            $request_booking_item = $request->booking_item;
            $statusBooking_item = Status::where("table_name", "=", "booking_item")->get();
            foreach ($request_booking_item as $key => $value) {
                $booking_item = Booking_Item::find($value['id']);
                $booking = Booking::find($booking_item['booking_id']);

                if (!$statusBooking_item->find($value['status_id'])) {
                    DatabaseLog::log($request, 'invalid status');
                    return $this->bookingResponse(204, 'invalid status', 'booking_item', '', Response::HTTP_NOT_FOUND);
                }

                if ($value['status_id'] <= 4  || $value['status_id'] >= 8  && $booking['status_id'] == 2) {
                    DatabaseLog::log($request, 'can not edit, booking is pending');
                    return $this->bookingResponse(204, 'can not edit, booking is pending', 'booking_item', '', Response::HTTP_NOT_FOUND);
                }

                if ($value['status_id'] <= 6  && $booking['status_id'] == 3) {
                    DatabaseLog::log($request, 'can not edit, booking is approve');
                    return $this->bookingResponse(204, 'can not edit, booking is approve', 'booking_item', '', Response::HTTP_NOT_FOUND);
                }
            }

            $response = array();

            foreach ($request_booking_item as $value) {
                $booking_item = Booking_Item::find($value['id']);

                $booking = Booking::find($booking_item['booking_id']);
                if (!$booking) {
                    DatabaseLog::log($request, 'not found');
                    return $this->bookingResponse(404, 'not found', 'booking', '', Response::HTTP_NOT_FOUND);
                }
                if ($booking['status_id'] == 1) {
                    DatabaseLog::log($request, 'customer not yet confirmed booking');
                    return $this->bookingResponse(210, 'customer not yet confirmed booking', 'booking', '', Response::HTTP_NOT_FOUND);
                }
                if ($booking['status_id'] == 4) {
                    DatabaseLog::log($request, 'can not edit, booking is completed');
                    return $this->bookingResponse(215, 'can not edit, booking is completed', 'booking', '', Response::HTTP_NOT_FOUND);
                }
                if (!$booking_item) {
                    DatabaseLog::log($request, 'not found');
                    return $this->bookingResponse(404, 'not found', 'booking_item', '', Response::HTTP_NOT_FOUND);
                }
                // return $this->bookingResponse(777, 'true', 'true', $value['status_id'], Response::HTTP_NOT_FOUND);
                // $booking_item->update([
                //     'status_id' => $value['status_id'],
                //     'note_owner' => $value['note_owner'],
                //     'updated_by' => Auth::user()->id,
                // ]);
                // $item_data = Item::find($booking_item['item_id']);
                // if ($item_data['is_not_return'] == 1) {
                //     $booking_item->update(['status_id' => 9, 'return_date' => Carbon::now()->setTimezone('Asia/Bangkok')]);
                // }
                array_push($response, $booking_item);
            }

            $booking_item = Booking_Item::where('booking_id', '=', $response[0]->booking_id)
                ->where('status_id', '!=', 5)
                ->where('status_id', '!=', 9)
                ->get();

            $booking_item_status = Booking_Item::where('booking_id', '=', $response[0]->booking_id)
                ->get();

            $status = array();
            foreach ($booking_item as $key => $value) {
                array_push($status, $value['status_id']);
            }
            // return $this->bookingResponse('9', '9', '9', $status, Response::HTTP_CREATED);

            $item_status = array();
            foreach ($booking_item_status as $key => $value) {
                array_push($item_status, $value['status_id']);
            }
            // return $this->bookingResponse('9', '9', '9', $item_status, Response::HTTP_CREATED);

            $isStatus = false;
            //เช็คหาสถานพทั้งหมดว่าเหมือนกันไหม
            foreach ($status as $value) {
                if ($status[0] != $value) {
                    $isStatus = false;
                    break;
                }
                $isStatus = true;
            }

            if (array_sum($item_status) / $item_status[0]  == count($item_status) && $item_status[0] == 5) { //เช็คหาสถานพทั้งหมดว่าเหมือน 5 
                $booking->update(['status_id' => 4]);
            } elseif (array_sum($item_status) / $item_status[0]  == count($item_status) && $item_status[0] == 9) { //เช็คหาสถานพทั้งหมดว่าเหมือน 9
                $booking->update(['status_id' => 4]);
            } elseif ($isStatus) { //เช็คหาสถานพทั้งหมดว่าเหมือนกันไหม
                if ($status[0] == 6) {
                    $booking->update(['status_id' => 2]);
                }
                if ($status[0] == 7) {
                    $booking_return = Booking_Item::where("booking_id", "=", $booking['id'])->get();
                    foreach ($booking_return as $value) {
                        $item_data = Item::find($value['item_id']);
                        $amount = $item_data['amount'] - $value['amount'];
                        if ($amount < 0) {
                            DatabaseLog::log($request, 'not enough item');
                            return $this->bookingResponse(202, 'not enough item', 'booking_item', '', Response::HTTP_NOT_FOUND);
                        }
                        $item_data->update(['amount' => $amount]);
                    }
                }
                if ($status[0] == 8) {
                    return $this->bookingResponse(777, '', '', 8, Response::HTTP_CREATED);
                }
            } else {
                $booking->update(['status_id' => 4]);
            }

            DatabaseLog::log($request, 'successfully');
            return $this->bookingResponse(101, 'successfully', 'booking_item', $response, Response::HTTP_CREATED);
        } catch (QueryException $exception) {
            DatabaseLog::log($request, (string) $exception->errorInfo[2]);
            return $this->bookingResponse(500, (string) $exception->errorInfo[2], 'booking_item', '', Response::HTTP_UNPROCESSABLE_ENTITY);
        } catch (Exception $exception) {
            Log::critical(': ' . $exception->getTraceAsString());
            DatabaseLog::log($request, (string) $exception->getMessage());
            return $this->bookingResponse(500, (string) $exception->getMessage(), 'booking_item', '', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}

//เช็คหาสถานพทั้งหมดว่าเหมือนกันไหม
// foreach ($status as $value) {
//     if ($status[0] != $value) {
//         $isStatus = false;
//         break;
//     }
//     $isStatus = true;
// }

// if ($isStatus) {
//     if ($status[0] == 5) {
//         $booking->update(['status_id' => 4]);
//     }
//     if ($status[0] == 6) {
//         $booking->update(['status_id' => 2]);
//     }
//     if ($status[0] == 7) {
//         $booking_return = Booking_Item::where("booking_id", "=", $booking['id'])->get();
//         foreach ($booking_return as $value) {
//             $item_data = Item::find($value['item_id']);
//             $amount = $item_data['amount'] - $value['amount'];
//             if ($amount < 0) {
//                 DatabaseLog::log($request, 'not enough item');
//                 return $this->bookingResponse(202, 'not enough item', 'booking_item', '', Response::HTTP_NOT_FOUND);
//             }
//             $item_data->update(['amount' => $amount]);
//         }

//         foreach ($booking_return as $value) {
//             $item_data = Item::find($value['item_id']);
//             if ($item_data['is_not_return'] == 1) {
//                 $value->update(['status_id' => 9, 'return_date' => Carbon::now()->setTimezone('Asia/Bangkok')]);
//             }
//         }
//         $booking->update(['status_id' => 3, 'verify_date' => Carbon::now()->setTimezone('Asia/Bangkok')]);
//     }
//     if ($status[0] == 8) {
//         $booking->update(['status_id' => 3]);
//     }
//     if ($status[0] == 9) {
//         $booking->update(['status_id' => 4]);
//         $booking_return = Booking_Item::where("booking_id", "=", $booking['id'])->get();
//         foreach ($booking_return as $value) {
//             $value->update(['return_date' => Carbon::now()->setTimezone('Asia/Bangkok')]);
//         }
//         foreach ($booking_return as $value) {
//             $item_data = Item::find($value['item_id']);
//             $item_data->update(['amount' => $item_data['amount'] + $value['amount']]);
//         }
//     }
// }