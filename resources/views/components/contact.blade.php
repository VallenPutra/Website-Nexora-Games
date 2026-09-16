@php
    $waNumber = config('nexora.whatsapp_number');
    $waMessage = rawurlencode(config('nexora.whatsapp_message'));
    $waLink = "https://wa.me/{$waNumber}?text={$waMessage}";
    $email = config('nexora.contact_email');
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

            {{-- Admin chat card --}}
            <div class="flex flex-col rounded-xl3 border-2 border-navy bg-white p-6">
                <span class="flex h-11 w-11 items-center justify-center rounded-xl2 bg-whatsapp/15 text-whatsapp">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" class="h-5 w-5 fill-current">
                        <path d="M16.001 2.667c-7.363 0-13.334 5.97-13.334 13.333 0 2.352.615 4.646 1.782 6.666l-1.89 6.9 7.07-1.855a13.27 13.27 0 0 0 6.372 1.622h.006c7.363 0 13.333-5.97 13.333-13.333 0-3.562-1.387-6.912-3.906-9.43a13.246 13.246 0 0 0-9.433-3.903zm0 24.4h-.005a11.06 11.06 0 0 1-5.64-1.545l-.405-.24-4.195 1.1 1.12-4.088-.264-.42a11.05 11.05 0 0 1-1.696-5.874c0-6.11 4.973-11.083 11.088-11.083 2.962 0 5.747 1.155 7.84 3.25a11.02 11.02 0 0 1 3.246 7.837c0 6.11-4.973 11.063-11.089 11.063z" />
                    </svg>
                </span>
                <h3 class="font-pixel mt-4 text-sm text-navy">CHAT ADMIN</h3>
                <p class="mt-2 text-sm text-navy/60">
                    Mau ngobrol langsung? Tim kami standby di WhatsApp, Senin&ndash;Jumat,
                    09.00&ndash;18.00 WIB.
                </p>
                <a href="{{ $waLink }}" target="_blank" rel="noopener" class="btn-whatsapp mt-5 w-fit">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" class="h-4 w-4 fill-white">
                        <path d="M16.001 2.667c-7.363 0-13.334 5.97-13.334 13.333 0 2.352.615 4.646 1.782 6.666l-1.89 6.9 7.07-1.855a13.27 13.27 0 0 0 6.372 1.622h.006c7.363 0 13.333-5.97 13.333-13.333 0-3.562-1.387-6.912-3.906-9.43a13.246 13.246 0 0 0-9.433-3.903zm0 24.4h-.005a11.06 11.06 0 0 1-5.64-1.545l-.405-.24-4.195 1.1 1.12-4.088-.264-.42a11.05 11.05 0 0 1-1.696-5.874c0-6.11 4.973-11.083 11.088-11.083 2.962 0 5.747 1.155 7.84 3.25a11.02 11.02 0 0 1 3.246 7.837c0 6.11-4.973 11.063-11.089 11.063zm6.078-8.293c-.333-.167-1.97-.972-2.276-1.083-.305-.111-.527-.167-.75.167-.222.333-.86 1.083-1.055 1.305-.194.222-.388.25-.72.083-.334-.167-1.409-.52-2.684-1.657-.992-.885-1.662-1.978-1.856-2.311-.194-.333-.02-.514.146-.68.15-.15.334-.389.5-.583.167-.195.222-.334.334-.556.111-.223.055-.417-.028-.584-.083-.167-.75-1.807-1.028-2.474-.27-.65-.545-.562-.75-.572l-.639-.011c-.222 0-.583.083-.888.417-.305.333-1.166 1.14-1.166 2.78 0 1.64 1.194 3.223 1.36 3.446.167.222 2.351 3.59 5.696 5.036.796.344 1.417.549 1.901.703.799.254 1.526.218 2.101.132.641-.096 1.97-.805 2.248-1.583.278-.778.278-1.445.195-1.584-.083-.139-.306-.222-.639-.389z" />
                    </svg>
                    Chat via WhatsApp
                </a>
                <p class="mt-3 text-xs text-navy/40">{{ $waNumber }}</p>
            </div>
        </div>
    </div>
</section>
