<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ChatMessage;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ChatController extends Controller
{
    /**
     * One row per guest conversation, newest activity first.
     */
    private function conversations()
    {
        $lastPerSession = ChatMessage::selectRaw('session_id, MAX(id) as last_id')
            ->groupBy('session_id')
            ->pluck('last_id');

        return ChatMessage::whereIn('id', $lastPerSession)
            ->orderByDesc('created_at')
            ->get()
            ->map(function (ChatMessage $last) {
                $unread = ChatMessage::where('session_id', $last->session_id)
                    ->where('sender_type', 'guest')
                    ->whereNull('read_at')
                    ->count();

                return [
                    'session_id' => $last->session_id,
                    'name' => $last->sender_name ?: 'Guest',
                    'preview' => Str::limit($last->body, 60),
                    'last_at' => $last->created_at,
                    'unread' => $unread,
                ];
            });
    }

    public function index(): View
    {
        $conversations = $this->conversations();

        return view('admin.chat.index', [
            'conversations' => $conversations,
            'activeSession' => null,
            'messages' => collect(),
        ]);
    }

    public function show(string $session): View
    {
        ChatMessage::where('session_id', $session)
            ->where('sender_type', 'guest')
            ->whereNull('read_at')
            ->update(['read_at' => now()]);

        return view('admin.chat.index', [
            'conversations' => $this->conversations(),
            'activeSession' => $session,
            'messages' => ChatMessage::where('session_id', $session)->orderBy('id')->get(),
        ]);
    }

    public function poll(Request $request, string $session): JsonResponse
    {
        $afterId = (int) $request->query('after', 0);

        $messages = ChatMessage::where('session_id', $session)
            ->when($afterId, fn ($q) => $q->where('id', '>', $afterId))
            ->orderBy('id')
            ->get();

        ChatMessage::where('session_id', $session)
            ->where('sender_type', 'guest')
            ->whereNull('read_at')
            ->update(['read_at' => now()]);

        return response()->json([
            'messages' => $messages->map(fn ($m) => [
                'id' => $m->id,
                'sender_type' => $m->sender_type,
                'sender_name' => $m->sender_name,
                'body' => $m->body,
                'time' => $m->created_at->format('H:i'),
            ]),
        ]);
    }

    public function reply(Request $request, string $session): RedirectResponse|JsonResponse
    {
        $validated = $request->validate([
            'message' => ['required', 'string', 'max:2000'],
        ]);

        $message = ChatMessage::create([
            'session_id' => $session,
            'sender_type' => 'admin',
            'sender_name' => $request->user()->name ?? 'Admin',
            'body' => $validated['message'],
        ]);

        if ($request->wantsJson()) {
            return response()->json([
                'message' => [
                    'id' => $message->id,
                    'sender_type' => $message->sender_type,
                    'sender_name' => $message->sender_name,
                    'body' => $message->body,
                    'time' => $message->created_at->format('H:i'),
                ],
            ]);
        }

        return back();
    }
}