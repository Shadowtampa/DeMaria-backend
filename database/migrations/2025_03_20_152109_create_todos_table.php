<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('todos', function (Blueprint $table) {
            $table->id();


            $table->string('title'); // Título da tarefa
            $table->text('description')->nullable(); // Descrição da tarefa (opcional)
            $table->enum('status', ['pendente', 'concluída'])->default('pendente'); // Status da tarefa
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Relacionamento com usuários

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('todos');
    }
};
