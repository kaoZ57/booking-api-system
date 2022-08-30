<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Database\QueryException;
use Exception;
use Illuminate\Support\Facades\Log;
use App\Models\Item;
use App\Models\Tag;
use App\Models\User;
use App\Models\Store;
use App\Models\Tag_Item;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ItemController extends Controller
{

    public function store(Request $request): JsonResponse
    {
        try {
            $request->validate([
                'item' => 'required'
            ]);

            foreach ($request->item['tag'] as  $value) {
                if (!Tag::find($value['id'])) {
                    return $this->bookingResponse(404, 'ไม่มีแทค', 'item', '', Response::HTTP_CREATED); //แก้
                }
            }

            $item = Item::create([
                'name' => $request->item['name'],
                'description' => $request->item['description'],
                'store_id' => $request->item['store_id'],
                'amount' => 0,
                'is_active' => $request->item['is_active'],
                'is_not_return' => $request->item['is_not_return'],
                'updated_by' => Auth::user()->id,
                'amount_update_at' => Carbon::now()->setTimezone('Asia/Bangkok'),

            ]);

            $item_tag = array();

            foreach ($request->item['tag'] as $value) {

                $tag = Tag_Item::create([
                    'item_id' => $item['id'],
                    'tag_id' => $value['id'],

                ]);

                array_push($item_tag, $tag);
            }

            $result = [
                'id' => $item['id'],
                'name' => $item['name'],
                'description' => $item['description'],
                'store_id' => $item['store_id'],
                'amount' => $item['amount'],
                'is_active' => $item['is_active'],
                'is_not_return' => $item['is_not_return'],
                'updated_by' => $item['updated_by'],
                'amount_update_at' => $item['amount_update_at'],
                'updated_by_name' => User::find($item['updated_by'])->name,
                'tag' =>  $item_tag,
            ];

            return $this->bookingResponse(201, 'successfully', 'item', $result, Response::HTTP_CREATED);
        } catch (QueryException $exception) {
            return $this->bookingResponse(500, (string) $exception->errorInfo[2], 'item', '', Response::HTTP_UNPROCESSABLE_ENTITY);
        } catch (Exception $exception) {
            Log::critical(': ' . $exception->getTraceAsString());
            return $this->bookingResponse(500, (string) $exception->getMessage(), 'item', '', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function show(Request $request): JsonResponse
    {
        try {
            // if ($request->filter) {
            //     if ($request->filter['item_id']) {
            //         $items = DB::table('item')
            //             ->where("id", "=", $request->filter['item_id'])
            //             ->get();
            //         return $this->bookingResponse(201, 'successful', 'item', $items, Response::HTTP_OK);
            //     }
            // }
            // if ($request->filter['tag_id']) {
            //     $items = DB::table('item')->where("id", "=", $request->filter['tag_id'])->get();
            //     return $this->bookingResponse(201, 'successful', 'item', $items, Response::HTTP_OK);
            // }
            // $items = DB::table('item')
            //     ->join('tag_item', 'item.id', '=', 'tag_item.item_id')
            //     ->join('tag', 'tag.id', '=', 'tag_item.tag_id')
            //     ->select('item.*', 'tag.name as tag_name')
            //     ->get();

            // if ($request->filter['item_id']) {
            //     $outputB = array_filter($response, function ($k, $v) {
            //         return $k == 'id' && $v == 1;
            //     }, ARRAY_FILTER_USE_BOTH);
            //     return $this->bookingResponse(201, 'successful', 'item', $outputB, Response::HTTP_OK);
            // }


            $items = Item::where('created_at', '<', Carbon::now()->setTimezone('Asia/Bangkok'));
            $response = array();

            if ($request->has('item_id')) {
                $items->where('id', "=", $request->item_id);
            }
            // if ($request->has('tag_id')) {
            //     $items->where('id', "=", $request->tag_id)->join('tag_item', $request->tag_id, '=', 'tag_item.tag_id');
            // }
            if ($request->has('name')) {
                $items->where('name', "like", "%{$request->name}%");
            }

            foreach ($items->get() as $value) {
                $tag_Item = Tag_Item::where("item_id", "=", $value["id"])->get();
                $tag_data = array();
                foreach ($tag_Item as  $value1) {
                    $tag =  Tag::where("id", "=", $value1["tag_id"])->get();
                    array_push($tag_data, $tag);
                }
                $itemdata = ([
                    'id' => $value['id'],
                    'store_id' => $value['store_id'],
                    'name' => $value['name'],
                    'description' => $value['description'],
                    'is_active' => $value['is_active'],
                    'is_not_return' => $value['is_not_return'],
                    'updated_by' => $value['updated_by'],
                    'amount' => $value['amount'],
                    'amount_update_at' => $value['amount_update_at'],
                    'created_at' => $value['created_at'],
                    'updated_at' => $value['updated_at'],
                    'tag' => $tag_data,
                ]);

                array_push($response, $itemdata);
            }
            return $this->bookingResponse(201, 'successful', 'item', $response, Response::HTTP_OK);
        } catch (QueryException $exception) {
            return $this->bookingResponse(500, (string) $exception->errorInfo[2], 'item', '', Response::HTTP_UNPROCESSABLE_ENTITY);
        } catch (Exception $exception) {
            Log::critical(': ' . $exception->getTraceAsString());
            return $this->bookingResponse(500, (string) $exception->getMessage(), 'item', '', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(Request $request): JsonResponse
    {
        try {
            $request->validate([
                'item' => 'required'
            ]);

            $item = Item::find($request->item['id']);
            if (!$item) {
                return $this->bookingResponse(404, 'ไม่มีของ', 'item', '',  Response::HTTP_NOT_FOUND); //แก้
            }

            $item->update([
                'name' => $request->item['name'],
                'description' => $request->item['description'],
                'is_active' => $request->item['is_active'],
                'is_not_return' => $request->item['is_not_return']
            ]);
            return $this->bookingResponse(201, 'successful', 'item', $item, Response::HTTP_OK);
        } catch (QueryException $exception) {
            return $this->commonResponse(500, (string) $exception->errorInfo[2], 'item', '', Response::HTTP_UNPROCESSABLE_ENTITY);
        } catch (Exception $exception) {
            Log::critical(': ' . $exception->getTraceAsString());
            return $this->commonResponse(500, (string) $exception->getMessage(), 'item', '', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
