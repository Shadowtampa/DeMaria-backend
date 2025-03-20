<?php

namespace App\Http\Controllers\Todo;

use App\Http\Controllers\Controller;
use App\Http\Services\Todo\TodoService;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Todo;
use Illuminate\Http\JsonResponse;

class GetTodoController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/Todo",
     *     summary="Lista todos os todos",
     *     tags={"Todos"},
     *     security={{"bearerAuth": {}}},
     *     @OA\Response(
     *         response=200,
     *         description="Lista de todos",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Todo")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Não autorizado"
     *     )
     * )
     */
    public function __construct(private TodoService $todoService) {}

    public function __invoke( int $id): JsonResponse
    {
        $todo = $this->todoService->get($id);

        return response()->json($todo);
    }
}
