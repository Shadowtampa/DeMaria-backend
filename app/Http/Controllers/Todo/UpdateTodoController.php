<?php

namespace App\Http\Controllers\Todo;

use App\Http\Controllers\Controller;
use App\Http\Requests\Todo\UpdateTodoRequest;
use App\Http\Services\Todo\TodoService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Request;
use App\Models\Todo;
use Illuminate\Http\JsonResponse;

class UpdateTodoController extends Controller
{
    public function __construct(private TodoService $todoService) {}

    public function __invoke(UpdateTodoRequest $request): JsonResponse
    {
        $todo = $this->todoService->update($request->toArray());

        return response()->json([
            'message' => 'Todo atualizado com sucesso!',
            'Todo' => $todo,
        ], 200);
    }
}
