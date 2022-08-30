<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Store;
use App\Models\Tag;
use App\Models\User;
use App\Http\Controllers\AccessController;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;
use Exception;

class TagController extends Controller
{

    public function store(Request $request): JsonResponse
    {
        try {
            $request->validate([
                'tag' => 'required',
            ]);

            $tag = Tag::create([
                'name' => $request->tag['name'],
                'store_id' => $request->tag['store_id'],
                'is_active' => $request->tag['is_active'],
            ]);

            return $this->bookingResponse(201, 'Tag Created successfully', 'tag', $tag,  Response::HTTP_CREATED);
        } catch (QueryException $exception) {
            return $this->bookingResponse(500, (string) $exception->errorInfo[2], 'tag', '',  Response::HTTP_UNPROCESSABLE_ENTITY);
        } catch (Exception $exception) {
            Log::critical(': ' . $exception->getTraceAsString());
            return $this->bookingResponse(500, (string) $exception->getMessage(), 'tag', '',  Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show(Request $request): JsonResponse
    {
        try {

            $tags = Tag::all();
            return $this->bookingResponse(201, "show successfully", 'tag', $tags, Response::HTTP_OK);
        } catch (QueryException $exception) {
            return $this->bookingResponse(500, (string) $exception->errorInfo[2], 'tag', '', Response::HTTP_UNPROCESSABLE_ENTITY);
        } catch (Exception $exception) {
            Log::critical(': ' . $exception->getTraceAsString());
            return $this->bookingResponse(500, (string) $exception->getMessage(), 'tag', '', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(Request $request): JsonResponse
    {
        try {
            $request->validate([
                'tag' => 'required',
            ]);

            $tag = Tag::find($request->tag['id']);
            if (!$tag) {
                return $this->bookingResponse(404, 'not found', 'store', '', Response::HTTP_NOT_FOUND);
            }

            $tag->update([
                'id' => $request->tag['id'],
                'name' => $request->tag['name'],
                'is_active' => $request->tag['is_active'],
            ]);
            return $this->bookingResponse(201, 'update successfully', 'tag', $tag, Response::HTTP_OK);
        } catch (QueryException $exception) {
            return $this->bookingResponse(500, (string) $exception->errorInfo[2], 'tag', '', Response::HTTP_UNPROCESSABLE_ENTITY);
        } catch (Exception $exception) {
            Log::critical(': ' . $exception->getTraceAsString());
            return $this->bookingResponse(500, (string) $exception->getMessage(), 'tag', '', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
