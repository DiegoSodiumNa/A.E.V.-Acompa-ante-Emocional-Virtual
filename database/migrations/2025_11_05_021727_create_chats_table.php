<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('chats', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable(); // Título del chat
            $table->json('messages'); // Historial (mensajes del usuario y del bot)
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('chats');
    }
};
