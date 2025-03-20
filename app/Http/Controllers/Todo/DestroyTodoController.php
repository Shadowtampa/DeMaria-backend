<?php

namespace App\Http\Controllers\Todo;

use App\Http\Controllers\Controller;
use App\Http\Services\Todo\TodoService;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Todo;
use Illuminate\Http\JsonResponse;

class DestroyTodoController extends Controller
{
    public function __construct(private TodoService $todoService) {}

    public function __invoke(int $id): JsonResponse
    {
        try {
            $this->todoService->delete($id);

            return response()->json([
                'message' => 'Todo removido com sucesso!'
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th
            ], 500);
        }
    }
}
