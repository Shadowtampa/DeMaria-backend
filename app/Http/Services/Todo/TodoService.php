<?php

namespace App\Http\Services\Todo;

use App\Http\Services\Service;
use App\Models\Todo;
use Illuminate\Http\Request;

class TodoService extends Service
{
    public function index()
    {
        return Todo::where("user_id", auth()->user()->id)->get();
    }

    public function store($request): Todo
    {
        return Todo::create($request);
    }
}