<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Todo\{GetTodoController, IndexTodoController, StoreTodoController, UpdateTodoController, DestroyTodoController};


// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::get('/', function () {
    return "HELLO WORLD";
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::prefix('todo')->middleware('auth:sanctum')->group(function () {
    Route::get('/', IndexTodoController::class); // Listar todos os todos
    Route::post('/', StoreTodoController::class); //  Criar novo todo
    // Route::get('{id}', GetTodoController::class); // Exibir um todo específico
    // Route::put('{id}', UpdateTodoController::class); // Atualizar todo
    // Route::delete('{id}', DestroyTodoController::class); // Deletar todo
});