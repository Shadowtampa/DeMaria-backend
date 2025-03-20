<?php

namespace App\Http\Services\Todo;

use App\Http\Services\Service;
use App\Models\Todo;
use Illuminate\Http\Request;

class IndexTodoService extends Service
{
    public function index()
    {
        return Todo::where("user_id", auth()->user()->id)->get();
    }
}