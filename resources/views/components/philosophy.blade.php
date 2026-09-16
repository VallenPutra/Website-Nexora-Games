<section id="studio" class="bg-peach">
    <div class="mx-auto max-w-6xl px-6 py-16 md:py-24">
        <span class="badge mb-6 bg-navy text-cream">Studio Philosophy</span>
        <h2 class="font-pixel text-2xl text-navy sm:text-3xl">WE MAKE GAMES ONE PIXEL AT A TIME.</h2>
        <p class="mt-4 max-w-xl text-sm text-navy/60">
            Nexora Games is an independent pixel-art game studio exploring colorful worlds,
            expressive characters, and simple ideas that turn into memorable adventures.
            No corporate focus groups, no synthetic shortcuts — just coffee, code, and heart.
        </p>

        <div class="mt-10 rounded-xl3 border-2 border-navy bg-cream p-6">
            <p class="mb-4 text-xs font-bold uppercase tracking-wide text-navy/50">The Indie Workshop Setup</p>
            <div class="grid grid-cols-2 gap-6 sm:grid-cols-3 md:grid-cols-6">
                @foreach ([
                    'CRT Monitors' => 'Native Grade',
                    'Sprite Sheets' => 'Frame-by-frame',
                    'Restricted Palettes' => 'Curse Colored',
                    'Steaming Mugs' => 'Heart-2-Beat',
                    'Floppy Archives' => 'Yellow Storage',
                    'Chiptune Synthesizers' => 'Square &amp; Wave',
                ] as $title => $sub)
                    <div class="text-center">
                        <div class="mx-auto mb-2 flex h-10 w-10 items-center justify-center rounded-lg bg-orange/20 text-orange">◆</div>
                        <p class="text-xs font-bold text-navy">{{ $title }}</p>
                        <p class="text-[11px] text-navy/50">{!! $sub !!}</p>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="mt-10 grid gap-8 md:grid-cols-3">
            <div>
                <span class="font-pixel text-xl text-orange">01</span>
                <h3 class="mt-3 font-sans text-base font-bold text-navy">Playful By Design</h3>
                <p class="mt-2 text-sm text-navy/60">
                    We believe games should spark curiosity and unadulterated joy. Mechanics should
                    feel tactile, immediate, and satisfying in a single line of code.
                </p>
            </div>
            <div>
                <span class="font-pixel text-xl text-orange">02</span>
                <h3 class="mt-3 font-sans text-base font-bold text-navy">Every Pixel Matters</h3>
                <p class="mt-2 text-sm text-navy/60">
                    Small details help bring a world to life. From chimney smoke drift patterns to
                    eye-blink timers on tiny NPCs, deliberate hand placement creates true soul.
                </p>
            </div>
            <div>
                <span class="font-pixel text-xl text-orange">03</span>
                <h3 class="mt-3 font-sans text-base font-bold text-navy">Keep Experimenting</h3>
                <p class="mt-2 text-sm text-navy/60">
                    Every adventure starts somewhere. We prototype rapidly, test wild ideas, discard
                    what feels dull, and polish the quirky mechanics that bring genuine smiles.
                </p>
            </div>
        </div>
    </div>
</section>
