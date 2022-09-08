<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Item;
use App\Models\User;
use App\Models\Status;
use App\Models\Tag;
use App\Models\Out_of_service;
use App\Models\Stock;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class FilterController extends Controller
{

    public static function user_filter(Request $request)
    {

        $users = User::where('created_at', '<', Carbon::now()->setTimezone('Asia/Bangkok'));

        if ($request->has('filter.user_id')) {
            $users->where('id', "=", $request->filter['user_id']);
        }
        if ($request->has('filter.name')) {
            $users->where('name', "like", "%{$request->filter['name']}%");
        }
        if ($request->has('filter.email')) {
            $users->where('email', "like", "%{$request->filter['email']}%");
        }
        if ($request->has('filter.limit')) {
            $users->limit($request->filter['limit']);
        }
        if ($request->has('filter.orderBy')) {
            $users->orderBy('id', $request->filter['orderBy']);
        }

        return  $users->get();
    }

    public static function tag_filter(Request $request)
    {
        $tags = Tag::where('created_at', '<', Carbon::now()->setTimezone('Asia/Bangkok'));

        if ($request->has('filter.tag_id')) {
            $tags->where('id', "=", $request->filter['tag_id']);
        }
        if ($request->has('filter.name')) {
            $tags->where('name', "like", "%{$request->filter['name']}%");
        }
        if ($request->has('filter.is_active')) {
            $tags->where('is_active', "=", $request->filter['is_active']);
        }
        if ($request->has('filter.limit')) {
            $tags->limit($request->filter['limit']);
        }
        if ($request->has('filter.orderBy')) {
            $tags->orderBy('id', $request->filter['orderBy']);
        }

        return  $tags->get();
    }

    public static function item_filter(Request $request)
    {

        // $item = QueryBuilder::for(Item::class)
        //     ->join('tag_item', 'tag_item.id', '=', 'item.id')
        //     ->join('tag', 'tag.id', '=', 'tag_item.tag_id')
        //     ->allowedFilters(['item.name', 'tag.name', 'item.is_not_return'])
        //     ->select('item.*',  'tag.name as tag_name')
        //     ->get();

        // return $item;

        $items = Item::where('created_at', '<', Carbon::now()->setTimezone('Asia/Bangkok'));

        if ($request->has('filter.item_id')) {
            $items->where('id', "=", $request->filter['item_id']);
        }
        if ($request->has('filter.name')) {
            $items->where('name', "like", "%{$request->filter['name']}%");
        }
        if ($request->has('filter.description')) {
            $items->where('description', "like", "%{$request->filter['description']}%");
        }
        if ($request->has('filter.is_active')) {
            $items->where('is_active', "=", $request->filter['is_active']);
        }
        if ($request->has('filter.is_not_return')) {
            $items->where('is_not_return', "=", $request->filter['is_not_return']);
        }
        if ($request->has('filter.updated_by')) {
            $items->where('updated_by', "=", $request->filter['updated_by']);
        }
        if ($request->has('filter.less_amount')) {
            $items->where('amount', "<=", $request->filter['less_amount']);
        }
        if ($request->has('filter.greater_amount')) {
            $items->where('amount', ">=", $request->filter['greater_amount']);
        }
        if ($request->has('filter.limit')) {
            $items->limit($request->filter['limit']);
        }
        if ($request->has('filter.orderBy')) {
            $items->orderBy('id', $request->filter['orderBy']);
        }

        return  $items->get();
    }

    public static function outOfService_filter(Request $request)
    {
        $out_of_services = Out_of_service::where('created_at', '<', Carbon::now()->setTimezone('Asia/Bangkok'));

        if ($request->has('filter.OutOfService_id')) {
            $out_of_services->where('id', "=", $request->filter['OutOfService_id']);
        }
        if ($request->has('filter.note')) {
            $out_of_services->where('note', "like", "%{$request->filter['note']}%");
        }
        if ($request->has('filter.less_amount')) {
            $out_of_services->where('amount', "<=", $request->filter['less_amount']);
        }
        if ($request->has('filter.greater_amount')) {
            $out_of_services->where('amount', ">=", $request->filter['greater_amount']);
        }
        if ($request->has('filter.ready_to_use')) {
            $out_of_services->where('ready_to_use', "=", $request->filter['ready_to_use']);
        }
        if ($request->has('filter.updated_by')) {
            $out_of_services->where('updated_by', "=", $request->filter['updated_by']);
        }
        if ($request->has('filter.limit')) {
            $out_of_services->limit($request->filter['limit']);
        }
        if ($request->has('filter.orderBy')) {
            $out_of_services->orderBy('id', $request->filter['orderBy']);
        }

        return  $out_of_services->get();
    }


    public static function booking_filter(Request $request)
    {
        // $test = DB::select('select name from status');
        // $booking = QueryBuilder::for(Booking::class)
        //     ->join('status', 'status.id', '=', 'booking.status_id')
        //     ->allowedFilters(['status.id', 'status.name'])

        //     ->select('booking.*', 'status.name as status_name')
        //     ->get();

        // return $booking;
        // return  Booking::whereBetween('start_date', ['2022-08-29', '2022-08-30'])->get();
        // return Booking::whereDate('start_date', '>=', '2022-08-31')->whereDate('start_date', '<=', '2022-09-30')->get();
        $bookings = Booking::where('created_at', '<', Carbon::now()->setTimezone('Asia/Bangkok'));


        if ($request->has('filter.booking_id')) {
            $bookings->where('id', "=", $request->filter['booking_id']);
        }
        if ($request->has('filter.users_id')) {
            $bookings->where('users_id', "=", $request->filter['users_id']);
        }
        if ($request->has('filter.start_date')) {
            $bookings->whereDate('start_date', "=", $request->filter['start_date']);
        }
        if ($request->has('filter.end_date')) {
            $bookings->whereDate('end_date', "=", $request->filter['end_date']);
        }
        if ($request->has('filter.verify_date')) {
            $bookings->where('verify_date', "=", $request->filter['verify_date']);
        }
        if ($request->has('filter.between')) {
            $start_date =  substr($request->filter['between'], 10);
            $end_date =  substr($request->filter['between'], -10);
            $bookings->whereDate('start_date', '>=', $start_date)->whereDate('start_date', '<=', $end_date);
        }

        if ($request->has('filter.status')) {
            if ($request->filter['status'] == "prepairing") {
                $bookings->where('status_id', "=", Status::where("name", "like", "101%")->first()->id);
            }
            if ($request->filter['status']  == "pending") {
                $bookings->where('status_id', "=", Status::where("name", "like", "102%")->first()->id);
            }
            if ($request->filter['status']  == "approve") {
                $bookings->where('status_id', "=", Status::where("name", "like", "103%")->first()->id);
            }
            if ($request->filter['status']  == "complete") {
                $bookings->where('status_id', "=", Status::where("name", "like", "104%")->first()->id);
            }
        }
        if ($request->has('filter.limit')) {
            $bookings->limit($request->filter['limit']);
        }
        if ($request->has('filter.orderBy')) {
            $bookings->orderBy('id', $request->filter['orderBy']);
        }

        return  $bookings->get();
    }

    public static function stock_filter(Request $request)
    {
        $stocks = Stock::where('created_at', '<', Carbon::now()->setTimezone('Asia/Bangkok'));

        if ($request->has('filter.stock_id')) {
            $stocks->where('id', "=", $request->filter['stock_id']);
        }
        if ($request->has('filter.start_date')) {
            $stocks->whereDate('updated_at', "=", $request->filter['start_date']);
        }
        if ($request->has('filter.between')) {
            $start_date =  substr($request->filter['between'], 10);
            $end_date =  substr($request->filter['between'], -10);
            $stocks->whereDate('updated_at', '>=', $start_date)->whereDate('updated_at', '<=', $end_date);
        }
        if ($request->has('filter.limit')) {
            $stocks->limit($request->filter['limit']);
        }
        if ($request->has('filter.orderBy')) {
            $stocks->orderBy('id', $request->filter['orderBy']);
        }

        return  $stocks->get();
    }

    // public function scopeStartsBetween()

    // {
    //     $booking = QueryBuilder::for(Booking::class)
    //         ->allowedFilters([
    //             AllowedFilter::scope('starts_between'),
    //         ])
    //         ->select('booking.*')
    //         ->get();


    //     return $booking;
    // }
}
