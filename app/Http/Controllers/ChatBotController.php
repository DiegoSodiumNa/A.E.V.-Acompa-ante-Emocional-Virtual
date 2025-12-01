<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chat;
use OpenAI\Laravel\Facades\OpenAI;

class ChatBotController extends Controller
{
    public function Emociones()
    {
        return view('herramientas.emociones');
    }

    public function Respiracion()
    {
        return view('herramientas.respiracion');
    }
    public function index($chatId = null)
    {
        $chats = Chat::latest()->get();
        $activeChat = $chatId ? Chat::findOrFail($chatId) : null;

        return view('ChatBot.index', compact('chats', 'activeChat'));
    }

    public function hablar(Request $request)
    {
        $request->validate([
            'message' => 'required|string',
            'chat_id' => 'nullable|exists:chats,id',
        ]);

        // Obtener o crear chat
        $chat = $request->chat_id
            ? Chat::findOrFail($request->chat_id)
            : Chat::create(['messages' => []]);

        // Historial existente
        $messages = $chat->messages ?? [];

        // Agregar nuevo mensaje del usuario
        $messages[] = ['role' => 'user', 'content' => $request->message];

        // Agregar prompt del sistema solo la primera vez
        // Usa la nueva clave `CHATBOT_SYSTE_PROMPT` y como respaldo `CHATBOT_SYSTEM_PROMPT`
        $systemPrompt = [
            'role' => 'system',
            'content' => env('CHATBOT_SYSTE_PROMPT', env('CHATBOT_SYSTEM_PROMPT', 'Eres un asistente de apoyo emocional.')),
        ];

        $conversation = $chat->wasRecentlyCreated
            ? array_merge([$systemPrompt], $messages)
            : $messages;

        // Enviar a la API
        $response = OpenAI::chat()->create([
            'model' => 'gpt-4o-mini',
            'messages' => $conversation,
        ]);

        $reply = $response->choices[0]->message->content;

        // Guardar respuesta del bot
        $messages[] = ['role' => 'assistant', 'content' => $reply];

        // Actualizar chat
        if (!$chat->title) {
            $chat->title = substr($request->message, 0, 40);
        }

        $chat->update(['messages' => $messages]);

        return response()->json([
            'reply' => $reply,
            'chat_id' => $chat->id,
        ]);
    }
}