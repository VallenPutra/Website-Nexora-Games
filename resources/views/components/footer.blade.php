@php
    $waNumber = config('nexora.whatsapp_number');
    $waMessage = rawurlencode(config('nexora.whatsapp_message'));
    $waLink = "https://wa.me/{$waNumber}?text={$waMessage}";
@endphp

<footer class="bg-navy">
    <div class="mx-auto max-w-6xl px-6 py-12">
        <div class="grid gap-10 md:grid-cols-3">
            <div>
                <div class="flex items-center gap-2">
                    <img src="{{ asset('images/sun-icon.png') }}" alt="" class="h-6 w-6" style="image-rendering: pixelated;">
                    <span class="font-pixel text-xs text-cream">NEXORA GAMES</span>
                </div>
                <p class="mt-3 text-sm font-bold text-cream/80">Small Pixels. Big Adventures.</p>
                <p class="mt-2 text-xs text-cream/40">
                    Handcrafted 2D pixel worlds from cozy imaginations, tactical mechanics, and
                    surprisingly deep game lore.
                </p>
            </div>

            <div>
                <p class="font-pixel text-[10px] text-cream/60">EXPLORE</p>
                <ul class="mt-4 flex flex-col gap-2 text-sm text-cream/70">
                    <li><a href="#games" class="hover:text-orange">Games</a></li>
                    <li><a href="#studio" class="hover:text-orange">Studio</a></li>
                    <li><a href="#devlog" class="hover:text-orange">Devlog</a></li>
                    <li><a href="#contact" class="hover:text-orange">Contact</a></li>
                </ul>
            </div>

            <div>
                <p class="font-pixel text-[10px] text-cream/60">OUTPOSTS &amp; SIGNAL</p>
                <ul class="mt-4 flex flex-col gap-2 text-sm text-cream/70">
                    <li><a href="mailto:hello@nexoragames.com" class="hover:text-orange">hello@nexoragames.com</a></li>
                    <li>
                        <a href="{{ $waLink }}" target="_blank" rel="noopener" class="flex items-center gap-2 hover:text-orange">
                            <span class="flex h-5 w-5 items-center justify-center rounded-full bg-whatsapp">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" class="h-3 w-3 fill-white">
                                    <path d="M16.001 2.667c-7.363 0-13.334 5.97-13.334 13.333 0 2.352.615 4.646 1.782 6.666l-1.89 6.9 7.07-1.855a13.27 13.27 0 0 0 6.372 1.622h.006c7.363 0 13.333-5.97 13.333-13.333 0-3.562-1.387-6.912-3.906-9.43a13.246 13.246 0 0 0-9.433-3.903z"/>
                                </svg>
                            </span>
                            WhatsApp: {{ $waNumber }}
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="mt-10 flex flex-col items-center justify-between gap-2 border-t border-cream/10 pt-6 text-xs text-cream/40 sm:flex-row">
            <p>© 2026 Nexora Games. All rights reserved.</p>
            <p>16-Bit Cartridge OS v0.8.4 // Handcrafted in 30-Bit</p>
        </div>
    </div>
</footer>
