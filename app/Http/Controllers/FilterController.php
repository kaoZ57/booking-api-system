<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Item;
use App\Models\Status;
use App\Models\Booking;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class FilterController extends Controller
{
    public function item_filter()
    {

        $item = QueryBuilder::for(Item::class)
            ->join('tag_item', 'tag_item.id', '=', 'item.id')
            ->join('tag', 'tag.id', '=', 'tag_item.tag_id')
            ->allowedFilters(['item.name', 'tag.name', 'item.is_not_return'])
            ->select('item.*',  'tag.name as tag_name')
            ->get();

        return $item;
    }

    public function booking_filter()
    {
        $test = DB::select('select name from status');
        $booking = QueryBuilder::for(Booking::class)
            ->join('status', 'status.id', '=', 'booking.status_id')
            ->allowedFilters(['status.id', 'status.name'])

            ->select('booking.*', 'status.name as status_name')
            ->get();

        return $booking;
    }

    public function scopeStartsBefore()

    {
        QueryBuilder::for(Booking::class)
            ->allowedFilters([
                AllowedFilter::scope('starts_before'),
            ])
            ->get();
    }
}
