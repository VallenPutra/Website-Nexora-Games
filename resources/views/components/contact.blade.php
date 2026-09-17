@php
    $waNumber = config('nexora.whatsapp_number');
    $waMessage = rawurlencode(config('nexora.whatsapp_message'));
    $waLink = "https://wa.me/{$waNumber}?text={$waMessage}";
    $email = config('nexora.contact_email');
    $captchaCode = \App\Http\Controllers\ContactController::captchaCode(request());
@endphp

<section class="bg-green-light">
    <div class="mx-auto max-w-4xl px-6 py-16 text-center md:py-20">
        <span class="badge mb-4 bg-white text-green">We reply fast</span>
        <h2 class="font-pixel text-xl text-navy sm:text-2xl">ADA PERTANYAAN? HUBUNGI KAMI.</h2>
        <p class="mx-auto mt-4 max-w-md text-sm text-navy/60">
            Tanya soal kolaborasi, rilis game, atau sekadar mau ngobrol soal dunia pixel — pilih
            cara yang paling nyaman buat kamu.
        </p>

        <div class="mt-10 grid gap-6 text-left sm:grid-cols-2">
            {{-- Email card --}}
            <div class="flex flex-col rounded-xl3 border-2 border-navy bg-white p-6">
                <span class="flex h-11 w-11 items-center justify-center rounded-xl2 bg-orange/20 text-orange">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 6.75A2.25 2.25 0 0 1 5.25 4.5h13.5A2.25 2.25 0 0 1 21 6.75v10.5A2.25 2.25 0 0 1 18.75 19.5H5.25A2.25 2.25 0 0 1 3 17.25V6.75Z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="m3.5 7 8.5 6 8.5-6" />
                    </svg>
                </span>
                <h3 class="font-pixel mt-4 text-sm text-navy">EMAIL US</h3>
                <p class="mt-2 text-sm text-navy/60">
                    Kirim email buat pertanyaan detail, kerja sama, atau media inquiry. Kami balas
                    dalam 1&ndash;2 hari kerja.
                </p>
                <a href="mailto:{{ $email }}" class="btn-outline mt-5 w-fit">
                    {{ $email }}
                </a>
            </div>

            {{-- Admin chat card: real-time chat with the admin (WhatsApp link kept as a secondary option) --}}
            <div
                x-data="nexoraChat()"
                x-init="init()"
                class="flex flex-col rounded-xl3 border-2 border-navy bg-white p-6"
            >
                <div class="flex items-center gap-3">
                    <span class="flex h-11 w-11 items-center justify-center rounded-xl2 bg-whatsapp/15 text-whatsapp">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" class="h-5 w-5 fill-current">
                            <path d="M16.001 2.667c-7.363 0-13.334 5.97-13.334 13.333 0 2.352.615 4.646 1.782 6.666l-1.89 6.9 7.07-1.855a13.27 13.27 0 0 0 6.372 1.622h.006c7.363 0 13.333-5.97 13.333-13.333 0-3.562-1.387-6.912-3.906-9.43a13.246 13.246 0 0 0-9.433-3.903z"/>
                        </svg>
                    </span>
                    <div>
                        <h3 class="font-pixel text-sm text-navy">CHAT ADMIN</h3>
                        <p class="flex items-center gap-1.5 text-xs font-semibold text-green">
                            <span class="h-1.5 w-1.5 rounded-full bg-green"></span> Online now
                        </p>
                    </div>
                </div>

                <p class="mt-3 text-sm text-navy/60">
                    Chat langsung sama tim kami, real-time — nggak perlu keluar dari halaman ini.
                </p>

                {{-- Message log --}}
                <div
                    x-ref="log"
                    class="mt-4 flex h-56 flex-col gap-2 overflow-y-auto rounded-xl2 border-2 border-navy/10 bg-cream p-3"
                >
                    <template x-if="messages.length === 0">
                        <p class="m-auto max-w-[80%] text-center text-xs text-navy/40">
                            Belum ada pesan. Mulai chat dengan tim Nexora Games di bawah 👇
                        </p>
                    </template>

                    <template x-for="msg in messages" :key="msg.id">
                        <div :class="msg.sender_type === 'admin' ? 'self-start items-start' : 'self-end items-end'" class="flex max-w-[85%] flex-col">
                            <span
                                :class="msg.sender_type === 'admin' ? 'bg-white text-navy border-2 border-navy/10' : 'bg-orange text-navy'"
                                class="rounded-xl2 px-3 py-2 text-sm"
                                x-text="msg.body"
                            ></span>
                            <span class="mt-0.5 text-[10px] text-navy/30" x-text="(msg.sender_type === 'admin' ? 'Admin · ' : 'Kamu · ') + msg.time"></span>
                        </div>
                    </template>
                </div>

                {{-- Composer --}}
                <form @submit.prevent="send()" class="mt-3 flex items-center gap-2">
                    <input
                        x-model="draft"
                        type="text"
                        placeholder="Tulis pesan..."
                        class="w-full rounded-xl2 border-2 border-navy/20 bg-cream px-4 py-2.5 text-sm text-navy placeholder:text-navy/40 focus:border-navy focus:outline-none"
                    >
                    <button type="submit" :disabled="sending || !draft.trim()" class="btn-primary shrink-0 px-4! py-2.5! disabled:opacity-50">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 12 3.269 3.126A59.77 59.77 0 0 1 21.485 12 59.77 59.77 0 0 1 3.27 20.874L5.999 12Zm0 0h7.5" />
                        </svg>
                    </button>
                </form>

                <p class="mt-2 text-xs text-navy/40" x-show="error" x-text="error"></p>

                <div class="mt-4 border-t border-navy/10 pt-4">
                    <a href="{{ $waLink }}" target="_blank" rel="noopener" class="flex items-center gap-2 text-xs font-bold text-navy/50 hover:text-whatsapp">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" class="h-4 w-4 fill-current">
                            <path d="M16.001 2.667c-7.363 0-13.334 5.97-13.334 13.333 0 2.352.615 4.646 1.782 6.666l-1.89 6.9 7.07-1.855a13.27 13.27 0 0 0 6.372 1.622h.006c7.363 0 13.333-5.97 13.333-13.333 0-3.562-1.387-6.912-3.906-9.43a13.246 13.246 0 0 0-9.433-3.903z"/>
                        </svg>
                        Prefer WhatsApp? Chat via WhatsApp instead
                    </a>
                    <p class="mt-2 text-xs text-navy/40">{{ $waNumber }}</p>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    function nexoraChat() {
        return {
            messages: [],
            draft: '',
            sending: false,
            error: '',
            lastId: 0,
            pollTimer: null,

            init() {
                this.poll();
                this.pollTimer = setInterval(() => this.poll(), 4000);
            },

            csrfToken() {
                return document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            },

            scrollToBottom() {
                this.$nextTick(() => {
                    this.$refs.log.scrollTop = this.$refs.log.scrollHeight;
                });
            },

            appendMessages(newMessages) {
                if (!newMessages || newMessages.length === 0) return;
                newMessages.forEach((m) => {
                    this.messages.push(m);
                    this.lastId = Math.max(this.lastId, m.id);
                });
                this.scrollToBottom();
            },

            async poll() {
                try {
                    const res = await fetch(`{{ route('chat.poll') }}?after=${this.lastId}`, {
                        credentials: 'same-origin',
                        headers: { 'Accept': 'application/json' },
                    });
                    if (!res.ok) return;
                    const data = await res.json();
                    this.appendMessages(data.messages);
                } catch (e) {
                    // Silent fail — the next poll cycle will retry.
                }
            },

            async send() {
                const body = this.draft.trim();
                if (!body) return;

                this.sending = true;
                this.error = '';

                try {
                    const res = await fetch(`{{ route('chat.send') }}`, {
                        method: 'POST',
                        credentials: 'same-origin',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': this.csrfToken(),
                        },
                        body: JSON.stringify({ message: body }),
                    });

                    if (!res.ok) {
                        this.error = 'Pesan gagal terkirim, coba lagi ya.';
                        return;
                    }

                    const data = await res.json();
                    this.appendMessages([data.message]);
                    this.draft = '';
                } catch (e) {
                    this.error = 'Pesan gagal terkirim, coba lagi ya.';
                } finally {
                    this.sending = false;
                }
            },
        };
    }
</script>

{{-- Contact form --}}
<section id="contact-form" class="bg-cream">
    <div class="mx-auto max-w-2xl px-6 py-16 md:py-20">
        <div class="mb-8 text-center">
            <span class="badge mb-4 bg-navy text-cream">Send a message</span>
            <h2 class="font-pixel text-xl text-navy sm:text-2xl">TULIS PESAN KAMU</h2>
            <p class="mx-auto mt-3 max-w-md text-sm text-navy/60">
                Isi form di bawah, tim kami akan balas ke email yang kamu kasih.
            </p>
        </div>

        @if(session('contact_success'))
            <div class="mb-6 rounded-xl2 border-2 border-green bg-green-light px-4 py-3 text-sm font-semibold text-navy">
                Pesan kamu berhasil terkirim. Terima kasih sudah menghubungi kami!
            </div>
        @endif

        <form method="POST" action="{{ route('contact.store') }}" class="rounded-xl3 border-2 border-navy bg-white p-6 sm:p-8">
            @csrf

            <div class="grid gap-5 sm:grid-cols-2">
                <div>
                    <label for="first_name" class="mb-1.5 block text-xs font-bold uppercase tracking-wide text-navy/70">
                        Nama Depan *
                    </label>
                    <input
                        id="first_name" type="text" name="first_name"
                        value="{{ old('first_name') }}" required
                        class="w-full rounded-xl2 border-2 border-navy px-4 py-2.5 text-navy placeholder:text-navy/40 focus:border-orange focus:outline-none"
                    >
                    @error('first_name') <p class="mt-1.5 text-xs font-semibold text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="last_name" class="mb-1.5 block text-xs font-bold uppercase tracking-wide text-navy/70">
                        Nama Belakang
                    </label>
                    <input
                        id="last_name" type="text" name="last_name"
                        value="{{ old('last_name') }}"
                        class="w-full rounded-xl2 border-2 border-navy px-4 py-2.5 text-navy placeholder:text-navy/40 focus:border-orange focus:outline-none"
                    >
                    @error('last_name') <p class="mt-1.5 text-xs font-semibold text-red-600">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="mt-5 grid gap-5 sm:grid-cols-2">
                <div>
                    <label for="mobile" class="mb-1.5 block text-xs font-bold uppercase tracking-wide text-navy/70">
                        Nomor HP *
                    </label>
                    <input
                        id="mobile" type="text" name="mobile"
                        value="{{ old('mobile') }}" required
                        placeholder="0812xxxxxxx"
                        class="w-full rounded-xl2 border-2 border-navy px-4 py-2.5 text-navy placeholder:text-navy/40 focus:border-orange focus:outline-none"
                    >
                    @error('mobile') <p class="mt-1.5 text-xs font-semibold text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="email" class="mb-1.5 block text-xs font-bold uppercase tracking-wide text-navy/70">
                        Email *
                    </label>
                    <input
                        id="email" type="email" name="email"
                        value="{{ old('email') }}" required
                        placeholder="you@example.com"
                        class="w-full rounded-xl2 border-2 border-navy px-4 py-2.5 text-navy placeholder:text-navy/40 focus:border-orange focus:outline-none"
                    >
                    @error('email') <p class="mt-1.5 text-xs font-semibold text-red-600">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="mt-5">
                <label for="message" class="mb-1.5 block text-xs font-bold uppercase tracking-wide text-navy/70">
                    Pesan *
                </label>
                <textarea
                    id="message" name="message" rows="5" required
                    placeholder="Tulis pertanyaan atau ide kolaborasi kamu di sini…"
                    class="w-full rounded-xl2 border-2 border-navy px-4 py-2.5 text-navy placeholder:text-navy/40 focus:border-orange focus:outline-none"
                >{{ old('message') }}</textarea>
                @error('message') <p class="mt-1.5 text-xs font-semibold text-red-600">{{ $message }}</p> @enderror
            </div>

            <div class="mt-5">
                <label for="captcha" class="mb-1.5 block text-xs font-bold uppercase tracking-wide text-navy/70">
                    Ketik Karakter Berikut *
                </label>
                <div class="flex flex-wrap items-center gap-3">
                    <span class="select-none rounded-xl2 border-2 border-dashed border-navy bg-cream px-5 py-2.5 font-pixel text-lg tracking-[0.3em] text-navy">
                        {{ strtoupper($captchaCode) }}
                    </span>
                    <a href="{{ route('contact.captcha-refresh') }}" class="text-xs font-bold text-navy/60 hover:text-orange-dark" aria-label="Refresh captcha">
                        &#x21bb; Refresh
                    </a>
                </div>
                <input
                    id="captcha" type="text" name="captcha"
                    autocomplete="off" required
                    placeholder="Ketik di sini"
                    class="mt-3 w-full max-w-xs rounded-xl2 border-2 border-navy px-4 py-2.5 text-navy placeholder:text-navy/40 focus:border-orange focus:outline-none"
                >
                @error('captcha') <p class="mt-1.5 text-xs font-semibold text-red-600">{{ $message }}</p> @enderror
            </div>

            <button type="submit" class="btn-primary mt-6 w-full sm:w-auto">
                Kirim Pesan
            </button>
        </form>
    </div>
</section>