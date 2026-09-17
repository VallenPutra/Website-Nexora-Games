@php
    $waNumber = config('nexora.whatsapp_number');
    $waMessage = rawurlencode(config('nexora.whatsapp_message'));
    $waLink = "https://wa.me/{$waNumber}?text={$waMessage}";
    $email = config('nexora.contact_email');
    $steamUrl = config('nexora.steam_url');
    $discordUrl = config('nexora.discord_url');
    $xUrl = config('nexora.x_url');

    // Same logic as navbar: on the homepage these are in-page anchors,
    // elsewhere they need to link back to the homepage first.
    $homeAnchor = request()->routeIs('home') ? '' : route('home');
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
                    <li><a href="{{ $homeAnchor }}#games" class="hover:text-orange">Games</a></li>
                    <li><a href="{{ $homeAnchor }}#studio" class="hover:text-orange">Studio</a></li>
                    <li><a href="{{ $homeAnchor }}#devlog" class="hover:text-orange">Devlog</a></li>
                    <li><a href="{{ route('contact') }}" class="hover:text-orange">Contact</a></li>
                </ul>
            </div>

            <div>
                <p class="font-pixel text-[10px] text-cream/60">SIGNAL</p>
                <ul class="mt-4 flex flex-col gap-2 text-sm text-cream/70">
                    <li><a href="mailto:{{ $email }}" class="hover:text-orange">{{ $email }}</a></li>
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

                <div class="mt-4 flex items-center gap-3">
                    <a href="{{ $steamUrl }}" target="_blank" rel="noopener" aria-label="Steam"
                       class="flex h-8 w-8 items-center justify-center rounded-full bg-cream/10 text-cream transition-colors hover:bg-orange hover:text-navy">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512" class="h-4 w-4 fill-current">
                            <path d="M496 256c0 137-111.2 248-248.4 248-113.8 0-209.6-76.3-239-180.4l95.2 39.3c6.4 32.1 34.9 56.4 68.9 56.4 39.2 0 71.9-32.4 70.2-73.7l84.5-60.7c52.1 1.5 95.9-40.7 95.9-93.5 0-51.6-42-93.5-93.7-93.5s-93.7 42-93.7 93.5v1.2L176.6 279c-14.4-.7-28.5 3.6-40.1 12.1L0 236.1C10.2 108.5 117.1 8 248.4 8 385.6 8 496 119 496 256zM155.7 384.3l-30.5-12.6a52.79 52.79 0 0 0 27.6 25.4c26.9 11.2 57.8-1.6 69-28.4 5.4-13 5.5-27.3.1-40.3-5.4-13-15.5-23.2-28.5-28.6-12.9-5.4-26.9-5.2-39.1-.6l31.5 13c19.8 8.2 29.2 30.9 21 50.7-8.2 19.8-30.9 29.2-50.7 21h-.4zm173.8-129.9c-34.4 0-62.4-28-62.4-62.4s28-62.4 62.4-62.4 62.4 28 62.4 62.4-27.9 62.4-62.4 62.4zm0-15.6c25.9 0 46.9-21 46.9-46.9s-21-46.9-46.9-46.9-46.9 21-46.9 46.9 21 46.9 46.9 46.9z"/>
                        </svg>
                    </a>
                    <a href="{{ $discordUrl }}" target="_blank" rel="noopener" aria-label="Discord"
                       class="flex h-8 w-8 items-center justify-center rounded-full bg-cream/10 text-cream transition-colors hover:bg-orange hover:text-navy">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" class="h-4 w-4 fill-current">
                            <path d="M524.531,69.836a1.5,1.5,0,0,0-.764-.7A485.065,485.065,0,0,0,404.081,32.03a1.816,1.816,0,0,0-1.923.91,337.461,337.461,0,0,0-14.9,30.6,447.848,447.848,0,0,0-134.426,0,309.541,309.541,0,0,0-15.135-30.6,1.89,1.89,0,0,0-1.924-.91A483.689,483.689,0,0,0,116.085,69.136a1.712,1.712,0,0,0-.788.676C39.068,183.651,18.186,294.69,28.43,404.354a2.016,2.016,0,0,0,.765,1.375A487.666,487.666,0,0,0,176.02,479.918a1.9,1.9,0,0,0,2.063-.676A348.2,348.2,0,0,0,208.12,430.4a1.86,1.86,0,0,0-1.019-2.588,321.173,321.173,0,0,1-45.868-21.853,1.885,1.885,0,0,1-.185-3.126c3.082-2.309,6.166-4.711,9.109-7.137a1.819,1.819,0,0,1,1.9-.256c96.229,43.917,200.41,43.917,295.5,0a1.812,1.812,0,0,1,1.924.233c2.944,2.426,6.027,4.851,9.132,7.16a1.884,1.884,0,0,1-.162,3.126,301.407,301.407,0,0,1-45.89,21.83,1.875,1.875,0,0,0-1,2.611,391.055,391.055,0,0,0,30.014,48.815,1.864,1.864,0,0,0,2.063.7A486.048,486.048,0,0,0,610.7,405.729a1.882,1.882,0,0,0,.765-1.352C623.729,277.594,590.933,167.465,524.531,69.836ZM222.491,337.58c-28.972,0-52.844-26.587-52.844-59.239S193.056,219.1,222.491,219.1c29.665,0,53.306,26.82,52.843,59.239C275.334,310.993,251.924,337.58,222.491,337.58Zm195.38,0c-28.971,0-52.843-26.587-52.843-59.239S388.437,219.1,417.871,219.1c29.667,0,53.307,26.82,52.844,59.239C470.715,310.993,447.538,337.58,417.871,337.58Z"/>
                        </svg>
                    </a>
                    <a href="{{ $xUrl }}" target="_blank" rel="noopener" aria-label="X"
                       class="flex h-8 w-8 items-center justify-center rounded-full bg-cream/10 text-cream transition-colors hover:bg-orange hover:text-navy">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="h-4 w-4 fill-current">
                            <path d="M389.2 48h70.6L305.6 224.2 487 464H345L233.7 318.6 106.5 464H35.8L200.7 275.5 26.8 48H172.4L272.9 180.9 389.2 48zM364.4 421.8h39.1L151.1 88h-42L364.4 421.8z"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>

        <div class="mt-10 flex flex-col items-center justify-between gap-2 border-t border-cream/10 pt-6 text-xs text-cream/40 sm:flex-row">
            <p>© 2026 Nexora Games. All rights reserved.</p>
            <p>16-Bit Cartridge OS v0.8.4 // Handcrafted in 30-Bit</p>
        </div>
    </div>
</footer>