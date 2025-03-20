<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Todo extends Model
{
    /** @use HasFactory<\Database\Factories\TodoFactory> */
    use HasFactory;

    protected $table = 'todos';

    protected $casts = [
        'is_active' => 'boolean'
    ];
    /**
     * Get the user that owns the Todo.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}