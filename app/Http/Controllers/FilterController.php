<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Database\Query\Builder;
use Spatie\QueryBuilder\AllowedFilter;



class FilterController extends Controller
{
    public function item_filter()
    {
        $items = QueryBuilder::for(Item::class)
            //->join('tag_item', 'tag_item.tag_id', 'tag.id')
            //->join('tag', 'tag.item_id', 'item.id')
            ->allowedFilters(['name', 'is_not_return', 'tag.name'])
            ->get();

        return $items;
    }

    public function booking_filter(Builder $query, $date): Builder
    {

        QueryBuilder::for(Booking::class)
            ->allowedFilters([
                AllowedFilter::scope('starts_before'),
            ])
            ->get();
        return $query->where('starts_at', '<=', Carbon::parse($date));
    }
}
