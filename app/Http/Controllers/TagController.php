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
use Carbon\Carbon;
use App\Http\Controllers\FilterController;
use App\Models\DatabaseLog;

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

            DatabaseLog::log($request, 'successfully');
            return $this->bookingResponse(101, 'successfully', 'tag', $tag,  Response::HTTP_CREATED);
        } catch (QueryException $exception) {
            DatabaseLog::log($request, (string) $exception->errorInfo[2]);
            return $this->bookingResponse(500, (string) $exception->errorInfo[2], 'tag', '',  Response::HTTP_UNPROCESSABLE_ENTITY);
        } catch (Exception $exception) {
            Log::critical(': ' . $exception->getTraceAsString());
            DatabaseLog::log($request, (string) $exception->getMessage());
            return $this->bookingResponse(500, (string) $exception->getMessage(), 'tag', '',  Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show(Request $request): JsonResponse
    {
        try {

            $tags = FilterController::tag_filter($request);

            DatabaseLog::log($request, 'successfully');
            return $this->bookingResponse(101, "successfully", 'tag', $tags, Response::HTTP_OK);
        } catch (QueryException $exception) {
            DatabaseLog::log($request, (string) $exception->errorInfo[2]);
            return $this->bookingResponse(500, (string) $exception->errorInfo[2], 'tag', '', Response::HTTP_UNPROCESSABLE_ENTITY);
        } catch (Exception $exception) {
            Log::critical(': ' . $exception->getTraceAsString());
            DatabaseLog::log($request, (string) $exception->getMessage());
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
                DatabaseLog::log($request, 'not found');
                return $this->bookingResponse(404, 'not found', 'store', '', Response::HTTP_NOT_FOUND);
            }

            $tag->update([
                'id' => $request->tag['id'],
                'name' => $request->tag['name'],
                'is_active' => $request->tag['is_active'],
            ]);

            DatabaseLog::log($request, 'successfully');
            return $this->bookingResponse(101, 'successfully', 'tag', $tag, Response::HTTP_OK);
        } catch (QueryException $exception) {
            DatabaseLog::log($request, (string) $exception->errorInfo[2]);
            return $this->bookingResponse(500, (string) $exception->errorInfo[2], 'tag', '', Response::HTTP_UNPROCESSABLE_ENTITY);
        } catch (Exception $exception) {
            Log::critical(': ' . $exception->getTraceAsString());
            DatabaseLog::log($request, (string) $exception->getMessage());
            return $this->bookingResponse(500, (string) $exception->getMessage(), 'tag', '', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
