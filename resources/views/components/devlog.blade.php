<section id="devlog" class="bg-cream">
    <div class="mx-auto max-w-6xl px-6 py-16 md:py-24">
        <div class="flex flex-col justify-between gap-4 md:flex-row md:items-end">
            <div>
                <span class="text-xs font-semibold uppercase tracking-wide text-navy/50">Developer Chronicles</span>
                <h2 class="mt-2 font-pixel text-2xl text-navy sm:text-3xl">BEHIND THE PIXELS.</h2>
            </div>
            <p class="max-w-sm text-sm text-navy/60">
                Sketches, experiments, and little discoveries from our development journey. Honest
                logs directly from our code &amp; art repository.
            </p>
        </div>

        <div class="mt-10 grid gap-6 md:grid-cols-3">
            @foreach ([
                ['tag' => 'Art Direction', 'date' => 'Spring 2026', 'title' => 'Designing Our First Pixel World', 'desc' => 'How we settled on a restricted 32-color palette and built a reusable tile set for the cozy villages of Dokherm.', 'img' => 'village-screenshot.png'],
                ['tag' => 'Animation', 'date' => 'Winter 2026', 'title' => 'How We Create Pixel Characters', 'desc' => 'Dissecting our 8-frame walk cycles, hearbeats, and how we exaggerated silhouettes for key characters.', 'img' => 'pixelbound-cover.png'],
                ['tag' => 'Dev Diary', 'date' => 'Late 2026', 'title' => 'From Sprite Sheet to Playable Game', 'desc' => 'Building snappy game feel: variable jumps, coyote time buffers, and micro-screen shake that makes attacks feel powerful.', 'img' => 'village-screenshot.png'],
            ] as $post)
                <article class="overflow-hidden rounded-xl3 border-2 border-navy bg-white">
                    <img src="{{ asset('images/' . $post['img']) }}" alt="{{ $post['title'] }}" class="h-40 w-full object-cover">
                    <div class="p-5">
                        <div class="flex items-center gap-3 text-xs">
                            <span class="badge bg-green-light text-green">{{ $post['tag'] }}</span>
                            <span class="text-navy/40">{{ $post['date'] }}</span>
                        </div>
                        <h3 class="mt-3 font-sans text-base font-bold text-navy">{{ $post['title'] }}</h3>
                        <p class="mt-2 text-sm text-navy/60">{{ $post['desc'] }}</p>
                        <a href="#" class="mt-4 inline-block text-sm font-bold text-orange-dark hover:underline">Read Entry →</a>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</section>
