<?php

use App\Http\Controllers\ChatBotController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('chatbot')->group(function(){
    Route::get('/{chat?}', [ChatBotController::class, 'index'])->name('chatbot.index');
    Route::post('/Hablar', [ChatBotController::class, 'Hablar'])->name('chatbot.hablar');
});

Route::prefix('herramientas')->group(function(){
    Route::get('/emociones', [ChatBotController::class, "Emociones"])->name('herramientas.emociones');
    Route::get('/respiracion', [ChatBotController::class, "Respiracion"])->name('herramientas.respiracion');
});