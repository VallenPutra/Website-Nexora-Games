<?php

namespace App\Http\Controllers;

use App\Models\ChatMessage;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Cookie;

class ChatController extends Controller
{
    public const COOKIE_NAME = 'nexora_chat_session';

    /**
     * Guest sends a message. A long-lived cookie identifies their
     * conversation thread so replies can be polled for and matched back,
     * without requiring the visitor to create an account.
     */
    public function send(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => ['nullable', 'string', 'max:100'],
            'message' => ['required', 'string', 'max:2000'],
        ]);

        $sessionId = $request->cookie(self::COOKIE_NAME) ?: (string) Str::uuid();

        $message = ChatMessage::create([
            'session_id' => $sessionId,
            'sender_type' => 'guest',
            'sender_name' => $validated['name'] ?? 'Guest',
            'body' => $validated['message'],
        ]);

        $cookie = new Cookie(
            self::COOKIE_NAME,
            $sessionId,
            time() + 60 * 60 * 24 * 30,
            '/',
            null,
            $request->secure(),
            true,
            false,
            'Lax'
        );

        return response()->json([
            'message' => $this->formatMessage($message),
        ])->withCookie($cookie);
    }

    /**
     * Guest polls for new messages (their own + admin replies) in their
     * thread, since the given message id.
     */
    public function poll(Request $request): JsonResponse
    {
        $sessionId = $request->cookie(self::COOKIE_NAME);

        if (! $sessionId) {
            return response()->json(['messages' => [], 'session_started' => false]);
        }

        $afterId = (int) $request->query('after', 0);

        $messages = ChatMessage::where('session_id', $sessionId)
            ->when($afterId, fn ($q) => $q->where('id', '>', $afterId))
            ->orderBy('id')
            ->get()
            ->map(fn ($m) => $this->formatMessage($m));

        return response()->json([
            'messages' => $messages,
            'session_started' => true,
        ]);
    }

    private function formatMessage(ChatMessage $message): array
    {
        return [
            'id' => $message->id,
            'sender_type' => $message->sender_type,
            'sender_name' => $message->sender_name,
            'body' => $message->body,
            'time' => $message->created_at->format('H:i'),
        ];
    }
}