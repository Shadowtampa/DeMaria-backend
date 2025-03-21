<?php

namespace App\Http\Controllers\Todo;

use App\Http\Controllers\Controller;
use App\Http\Requests\Todo\AutomateTodoRequest;
use App\Http\Requests\Todo\StoreTodoRequest;
use App\Http\Services\Todo\TodoService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Request;
use App\Models\Todo;
use Illuminate\Http\JsonResponse;

class AutomateTodoController extends Controller
{
    public function __construct(private TodoService $todoService) {}

    public function __invoke(AutomateTodoRequest $request): JsonResponse
    {
        $todo = $this->todoService->automate($request->toArray());

        return response()->json([
            'message' => 'Todos criados com sucesso!',
            'Todo' => $todo,
        ], 201);
    }
}
