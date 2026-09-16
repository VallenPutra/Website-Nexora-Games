<section id="games" class="bg-cream">
    <div class="mx-auto max-w-6xl px-6 py-16 md:py-24">
        <div class="flex flex-col justify-between gap-4 md:flex-row md:items-end">
            <div>
                <span class="text-xs font-semibold uppercase tracking-wide text-navy/50">The Nexora Universe</span>
                <h2 class="mt-2 font-pixel text-2xl text-navy sm:text-3xl">MORE GAMES. MORE LITTLE WORLDS.</h2>
            </div>
            <p class="max-w-sm text-sm text-navy/60">
                A collection of ideas, experiments, and adventures from our pixel-art universe.
                Playable concepts and in-progress worlds.
            </p>
        </div>

        <div class="mt-10 grid gap-6 md:grid-cols-2">
            <div class="flex flex-col overflow-hidden rounded-xl3 border-2 border-navy bg-white">
                <div class="relative">
                    <img src="{{ asset('images/pixelbound-cover.png') }}" alt="Pixelbound" class="h-56 w-full object-cover sm:h-72">
                    <span class="badge absolute left-4 top-4 bg-orange text-navy">FLAGSHIP TITLE</span>
                    <span class="badge absolute right-4 top-4 bg-navy text-cream">DEMO READY</span>
                </div>
                <div class="flex flex-1 flex-col justify-between gap-4 p-6">
                    <div>
                        <h3 class="font-pixel text-base text-navy">PIXELBOUND</h3>
                        <p class="mt-2 text-sm text-navy/60">Adventure Platformer</p>
                        <p class="mt-2 text-sm text-navy/60">
                            A colorful journey through a mysterious pixel world. Jump across ancient
                            mossy ruins, battle quirky creatures, and unlock forgotten relics.
                        </p>
                    </div>
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-navy/40">Genre: Action Adventure // Release: Late 2026</span>
                        <a href="#" class="font-bold text-orange-dark hover:underline">View Project →</a>
                    </div>
                </div>
            </div>

            <div class="grid gap-6">
                <div class="flex items-center gap-5 rounded-xl3 border-2 border-navy bg-white p-4">
                    <div class="h-24 w-24 shrink-0 overflow-hidden rounded-xl2 bg-green-light">
                        <img src="{{ asset('images/village-screenshot.png') }}" alt="Moonberry" class="h-full w-full object-cover">
                    </div>
                    <div class="flex-1">
                        <span class="badge bg-green-light text-green">In Development</span>
                        <h3 class="mt-2 font-pixel text-sm text-navy">MOONBERRY</h3>
                        <p class="mt-1 text-xs text-navy/60">
                            A tiny village, strange creatures, and a lot of berries. Cultivate enchanted
                            orchards, bake spirit tarts, and bring happiness back to the forest.
                        </p>
                        <a href="#" class="mt-2 inline-block text-xs font-bold text-orange-dark hover:underline">View Project →</a>
                    </div>
                </div>

                <div class="flex items-center gap-5 rounded-xl3 border-2 border-navy bg-white p-4">
                    <div class="h-24 w-24 shrink-0 overflow-hidden rounded-xl2 bg-purple/10">
                        <img src="{{ asset('images/pixelbound-cover.png') }}" alt="Starforge" class="h-full w-full object-cover">
                    </div>
                    <div class="flex-1">
                        <span class="badge bg-purple/10 text-purple">Prototype</span>
                        <h3 class="mt-2 font-pixel text-sm text-navy">STARFORGE</h3>
                        <p class="mt-1 text-xs text-navy/60">
                            Explore a forgotten space world filled with celestial worms, rogue automatons,
                            and modular star-engines waiting to be rebuilt.
                        </p>
                        <a href="#" class="mt-2 inline-block text-xs font-bold text-orange-dark hover:underline">View Project →</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
