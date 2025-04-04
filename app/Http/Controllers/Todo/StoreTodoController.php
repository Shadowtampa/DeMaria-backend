<?php

namespace App\Http\Controllers\Todo;

use App\Http\Controllers\Controller;
use App\Http\Requests\Todo\StoreTodoRequest;
use App\Http\Services\Todo\TodoService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Request;
use App\Models\Todo;
use Illuminate\Http\JsonResponse;

class StoreTodoController extends Controller
{
    public function __construct(private TodoService $todoService) {}

    public function __invoke(StoreTodoRequest $request): JsonResponse
    {
        $todo = $this->todoService->store($request->toArray());

        return response()->json([
            'message' => 'Todo criado com sucesso!',
            'Todo' => $todo,
        ], 201);
    }
}
