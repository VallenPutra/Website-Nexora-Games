@extends('admin.layouts.app')

@section('title', 'Messages')

@section('content')

<div
    class="mx-auto flex h-[calc(100vh-8rem)] max-w-7xl gap-5"
    x-data="adminChat({{ $activeSession ? \Illuminate\Support\Js::from($activeSession) : 'null' }}, {{ \Illuminate\Support\Js::from($messages->map(fn ($m) => [
        'id' => $m->id,
        'sender_type' => $m->sender_type,
        'sender_name' => $m->sender_name,
        'body' => $m->body,
        'time' => $m->created_at->format('H:i'),
    ])) }})"
    x-init="init()"
>
    {{-- Conversation list --}}
    <aside class="admin-card flex w-72 flex-none flex-col overflow-hidden">
        <div class="border-b border-admin-border px-4 py-3.5">
            <h2 class="text-sm font-bold text-admin-text">Conversations</h2>
            <p class="text-xs text-admin-muted">Messages from the contact page's live chat</p>
        </div>

        <div class="admin-scrollbar flex-1 overflow-y-auto">
            @forelse ($conversations as $conv)
                <a
                    href="{{ route('admin.chat.show', $conv['session_id']) }}"
                    class="flex flex-col gap-1 border-b border-admin-border px-4 py-3 transition-colors hover:bg-admin-bg {{ $activeSession === $conv['session_id'] ? 'bg-admin-orange/10' : '' }}"
                >
                    <div class="flex items-center justify-between gap-2">
                        <span class="truncate text-sm font-semibold text-admin-text">{{ $conv['name'] }}</span>
                        @if ($conv['unread'] > 0)
                            <span class="admin-badge admin-badge-orange">{{ $conv['unread'] }}</span>
                        @endif
                    </div>
                    <span class="truncate text-xs text-admin-muted">{{ $conv['preview'] }}</span>
                    <span class="text-[10px] text-admin-muted/70">{{ $conv['last_at']->diffForHumans() }}</span>
                </a>
            @empty
                <p class="p-4 text-center text-sm text-admin-muted">No conversations yet.</p>
            @endforelse
        </div>
    </aside>

    {{-- Active thread --}}
    <section class="admin-card flex flex-1 flex-col overflow-hidden">
        @if ($activeSession)
            <div class="flex items-center justify-between border-b border-admin-border px-5 py-3.5">
                <div>
                    <h2 class="text-sm font-bold text-admin-text">{{ $messages->first()->sender_name ?: 'Guest' }}</h2>
                    <p class="text-xs text-admin-muted">Live chat · updates every few seconds</p>
                </div>
            </div>

            <div x-ref="log" class="admin-scrollbar flex-1 space-y-3 overflow-y-auto p-5">
                <template x-for="msg in messages" :key="msg.id">
                    <div :class="msg.sender_type === 'admin' ? 'items-end self-end' : 'items-start self-start'" class="flex max-w-[70%] flex-col">
                        <span
                            :class="msg.sender_type === 'admin' ? 'bg-admin-orange text-white' : 'bg-admin-bg text-admin-text border border-admin-border'"
                            class="rounded-admin-md px-3.5 py-2 text-sm"
                            x-text="msg.body"
                        ></span>
                        <span class="mt-1 text-[10px] text-admin-muted" x-text="(msg.sender_type === 'admin' ? 'You · ' : '') + msg.time"></span>
                    </div>
                </template>
            </div>

            <form @submit.prevent="reply()" class="flex items-center gap-2 border-t border-admin-border p-4">
                <input
                    x-model="draft"
                    type="text"
                    placeholder="Type a reply..."
                    class="w-full rounded-admin-md border border-admin-border bg-admin-bg px-4 py-2.5 text-sm text-admin-text placeholder:text-admin-muted focus:border-admin-orange focus:outline-none"
                >
                <button type="submit" :disabled="sending || !draft.trim()" class="inline-flex shrink-0 items-center justify-center gap-2 rounded-admin-md bg-admin-orange px-4 py-2.5 text-sm font-bold text-white transition-colors hover:bg-admin-orange-dark disabled:opacity-50">
                    Send
                </button>
            </form>
        @else
            <div class="flex flex-1 flex-col items-center justify-center gap-2 p-10 text-center">
                <p class="text-sm font-semibold text-admin-text">Select a conversation</p>
                <p class="max-w-xs text-xs text-admin-muted">Pick a visitor on the left to view and reply to their live chat messages.</p>
            </div>
        @endif
    </section>
</div>

<script>
    function adminChat(initialSession, initialMessages) {
        return {
            sessionId: initialSession,
            messages: initialMessages || [],
            draft: '',
            sending: false,
            lastId: (initialMessages || []).reduce((max, m) => Math.max(max, m.id), 0),
            pollTimer: null,

            init() {
                this.scrollToBottom();
                if (this.sessionId) {
                    this.pollTimer = setInterval(() => this.poll(), 4000);
                }
            },

            csrfToken() {
                return document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            },

            scrollToBottom() {
                this.$nextTick(() => {
                    if (this.$refs.log) this.$refs.log.scrollTop = this.$refs.log.scrollHeight;
                });
            },

            async poll() {
                if (!this.sessionId) return;
                try {
                    const res = await fetch(`/admin/chat/${this.sessionId}/poll?after=${this.lastId}`, {
                        credentials: 'same-origin',
                        headers: { 'Accept': 'application/json' },
                    });
                    if (!res.ok) return;
                    const data = await res.json();
                    if (data.messages && data.messages.length) {
                        data.messages.forEach((m) => {
                            this.messages.push(m);
                            this.lastId = Math.max(this.lastId, m.id);
                        });
                        this.scrollToBottom();
                    }
                } catch (e) {
                    // Retry on next cycle.
                }
            },

            async reply() {
                const body = this.draft.trim();
                if (!body || !this.sessionId) return;

                this.sending = true;
                try {
                    const res = await fetch(`/admin/chat/${this.sessionId}/reply`, {
                        method: 'POST',
                        credentials: 'same-origin',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': this.csrfToken(),
                        },
                        body: JSON.stringify({ message: body }),
                    });
                    if (!res.ok) return;
                    const data = await res.json();
                    this.messages.push(data.message);
                    this.lastId = Math.max(this.lastId, data.message.id);
                    this.draft = '';
                    this.scrollToBottom();
                } finally {
                    this.sending = false;
                }
            },
        };
    }
</script>

@endsection
