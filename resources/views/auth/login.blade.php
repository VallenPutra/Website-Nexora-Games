<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In — Nexora Games</title>
    <link rel="icon" href="{{ asset('images/sun-icon.png') }}" type="image/png">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-cream">

    <header class="border-b-2 border-navy bg-cream">
        <div class="mx-auto flex max-w-6xl items-center justify-between px-6 py-4">
            <a href="{{ route('home') }}" class="flex items-center gap-2">
                <img src="{{ asset('images/sun-icon.png') }}" alt="Nexora Games" class="h-7 w-7" style="image-rendering: pixelated;">
                <span class="font-pixel text-sm text-navy">NEXORA GAMES</span>
            </a>
            <a href="{{ route('home') }}" class="text-sm font-bold text-navy/60 hover:text-orange-dark">&larr; Back to site</a>
        </div>
    </header>

    <main class="mx-auto flex max-w-6xl items-center justify-center px-6 py-16 sm:py-24">
        <div class="w-full max-w-md">

            <div class="mb-6 text-center">
                <span class="badge bg-navy text-cream">PLAYER ACCESS</span>
                <h1 class="font-pixel mt-4 text-2xl leading-[1.6] text-navy">SIGN IN</h1>
                <p class="mt-2 text-sm text-navy/70">
                    Enter your credentials to continue the adventure.
                </p>
            </div>

            @if (session('status'))
                <div class="mb-6 rounded-xl2 border-2 border-green bg-green-light px-4 py-3 text-sm font-semibold text-navy">
                    {{ session('status') }}
                </div>
            @endif

            <div class="overflow-hidden rounded-xl3 border-2 border-navy bg-navy">
                <div class="flex items-center gap-2 border-b-2 border-navy px-4 py-2">
                    <span class="h-2.5 w-2.5 rounded-full bg-orange"></span>
                    <span class="h-2.5 w-2.5 rounded-full bg-green"></span>
                    <span class="h-2.5 w-2.5 rounded-full bg-purple"></span>
                    <span class="ml-2 text-xs text-cream/60">player_login.exe</span>
                </div>

                <div class="bg-cream px-6 py-8 sm:px-8">
                    <form method="POST" action="{{ route('login') }}" class="flex flex-col gap-5">
                        @csrf

                        <div>
                            <label for="email" class="mb-1.5 block text-xs font-bold uppercase tracking-wide text-navy/70">
                                Email
                            </label>
                            <input
                                id="email"
                                type="email"
                                name="email"
                                value="{{ old('email') }}"
                                required
                                autofocus
                                autocomplete="username"
                                placeholder="you@example.com"
                                class="w-full rounded-xl2 border-2 border-navy bg-cream px-4 py-2.5 text-navy placeholder:text-navy/40 focus:border-orange focus:outline-none"
                            >
                            @error('email')
                                <p class="mt-1.5 text-xs font-semibold text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <div class="mb-1.5 flex items-center justify-between">
                                <label for="password" class="block text-xs font-bold uppercase tracking-wide text-navy/70">
                                    Password
                                </label>
                            </div>
                            <input
                                id="password"
                                type="password"
                                name="password"
                                required
                                autocomplete="current-password"
                                placeholder="&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;"
                                class="w-full rounded-xl2 border-2 border-navy bg-cream px-4 py-2.5 text-navy placeholder:text-navy/40 focus:border-orange focus:outline-none"
                            >
                            @error('password')
                                <p class="mt-1.5 text-xs font-semibold text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <label class="flex select-none items-center gap-2 text-sm text-navy/70">
                            <input type="checkbox" name="remember" class="h-4 w-4 rounded border-2 border-navy text-orange focus:ring-orange">
                            Remember me
                        </label>

                        <button type="submit" class="btn-primary mt-1 w-full justify-center">
                            Enter The World
                        </button>
                    </form>
                </div>
            </div>

            <p class="mt-6 text-center text-sm text-navy/60">
                New to Nexora?
                <a href="{{ route('home') }}#contact" class="font-bold text-navy hover:text-orange-dark">Contact the studio</a>
                to request access.
            </p>
        </div>
    </main>

    <x-chat-bubble />

</body>
</html>
