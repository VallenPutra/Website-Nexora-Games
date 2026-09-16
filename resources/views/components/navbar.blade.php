<nav x-data="{ open: false }" class="sticky top-0 z-50 border-b-2 border-navy bg-cream">
    <div class="mx-auto flex max-w-6xl items-center justify-between px-6 py-4">
        <a href="{{ route('home') }}" class="flex items-center gap-2">
            <img src="{{ asset('images/sun-icon.png') }}" alt="Nexora Games" class="h-7 w-7" style="image-rendering: pixelated;">
            <span class="font-pixel text-sm text-navy">NEXORA GAMES</span>
            <span class="badge hidden bg-navy text-cream sm:inline-flex">INDIE STUDIO</span>
        </a>

        <div class="hidden items-center gap-8 font-sans font-semibold text-navy md:flex">
            <a href="#games" class="hover:text-orange-dark">Games</a>
            <a href="#studio" class="hover:text-orange-dark">Studio</a>
            <a href="#devlog" class="hover:text-orange-dark">Devlog</a>
            <a href="{{ route('contact') }}" class="hover:text-orange-dark">Contact</a>
            <a href="{{ route('login') }}" class="hover:text-orange-dark">Login</a>
        </div>

        <div class="flex items-center gap-3">
            <a href="#games" class="btn-primary hidden sm:inline-flex">Play With Us</a>
            <button @click="open = !open" class="rounded-lg border-2 border-navy p-2 md:hidden" aria-label="Toggle menu">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>
    </div>

    <div x-show="open" x-cloak class="border-t-2 border-navy bg-cream px-6 py-4 md:hidden">
        <div class="flex flex-col gap-4 font-sans font-semibold text-navy">
            <a href="#games" @click="open = false">Games</a>
            <a href="#studio" @click="open = false">Studio</a>
            <a href="#devlog" @click="open = false">Devlog</a>
            <a href="{{ route('contact') }}" @click="open = false">Contact</a>
            <a href="{{ route('login') }}" @click="open = false">Login</a>
            <a href="#games" class="btn-primary w-fit">Play With Us</a>
        </div>
    </div>
</nav>
