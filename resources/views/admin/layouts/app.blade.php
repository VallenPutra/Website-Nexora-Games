<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') — Nexora Games Admin</title>
    <link rel="icon" href="{{ asset('images/sun-icon.png') }}" type="image/png">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @vite(['resources/css/admin.css', 'resources/js/admin.js'])
</head>
<body class="admin-body" x-data="{ sidebarOpen: false }">

    {{-- Mobile sidebar overlay --}}
    <div
        x-show="sidebarOpen"
        x-cloak
        @click="sidebarOpen = false"
        class="fixed inset-0 z-40 bg-black/40 lg:hidden"
    ></div>

    <div class="flex min-h-screen">

        {{-- ============ SIDEBAR ============ --}}
        <aside
            class="fixed inset-y-0 left-0 z-50 flex w-64 -translate-x-full transform flex-col bg-admin-sidebar transition-transform duration-200 lg:static lg:translate-x-0"
            :class="sidebarOpen && 'translate-x-0!'"
        >
            <div class="flex items-center gap-3 px-5 py-6">
                <img src="{{ asset('images/sun-icon.png') }}" alt="" class="h-8 w-8" style="image-rendering: pixelated;">
                <div class="leading-tight">
                    <p class="font-sans text-sm font-extrabold text-white">NEXORA GAMES</p>
                    <p class="font-mono text-[10px] tracking-wider text-white/45">STUDIO MANAGEMENT</p>
                </div>
                <button @click="sidebarOpen = false" class="ml-auto rounded-lg p-1.5 text-white/50 hover:bg-white/5 lg:hidden" aria-label="Close menu">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"/></svg>
                </button>
            </div>

            <nav class="admin-scrollbar flex-1 overflow-y-auto px-3 pb-4">
                <p class="admin-nav-group-label">Overview</p>
                <a href="{{ route('admin.dashboard') }}" class="admin-nav-link {{ request()->routeIs('admin.dashboard') ? 'is-active' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4.5 w-4.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="3" y="3" width="7" height="9" rx="1.5"/><rect x="14" y="3" width="7" height="5" rx="1.5"/><rect x="14" y="12" width="7" height="9" rx="1.5"/><rect x="3" y="16" width="7" height="5" rx="1.5"/></svg>
                    Dashboard
                </a>

                <p class="admin-nav-group-label">Content</p>
                <a href="#" aria-disabled="true" class="admin-nav-link is-disabled">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4.5 w-4.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="3" y="4" width="18" height="16" rx="2"/><path d="M3 9h18M9 4v16"/></svg>
                    Games
                    <span class="admin-soon-tag">Soon</span>
                </a>
                <a href="#" aria-disabled="true" class="admin-nav-link is-disabled">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4.5 w-4.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M4 4h13l3 3v13H4Z"/><path d="M8 9h8M8 13h8M8 17h5"/></svg>
                    Devlog
                    <span class="admin-soon-tag">Soon</span>
                </a>
                <a href="#" aria-disabled="true" class="admin-nav-link is-disabled">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4.5 w-4.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="9" cy="10" r="2"/><path d="m21 15-5-5-9 9"/></svg>
                    Media Library
                    <span class="admin-soon-tag">Soon</span>
                </a>

                <p class="admin-nav-group-label">Communication</p>
                <a href="{{ route('admin.chat') }}" class="admin-nav-link {{ request()->routeIs('admin.chat*') ? 'is-active' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4.5 w-4.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="m3 7 9 6 9-6"/></svg>
                    Messages
                </a>

                <p class="admin-nav-group-label">System</p>
                <a href="#" aria-disabled="true" class="admin-nav-link is-disabled">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4.5 w-4.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 1 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 1 1-2.83-2.83l.06-.06A1.65 1.65 0 0 0 4.6 15a1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1 0-4h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 1 1 2.83-2.83l.06.06A1.65 1.65 0 0 0 9 4.6a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 1 1 2.83 2.83l-.06.06A1.65 1.65 0 0 0 19.4 9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1Z"/></svg>
                    Settings
                    <span class="admin-soon-tag">Soon</span>
                </a>
            </nav>

            {{-- Sidebar footer: admin profile + logout --}}
            <div class="border-t border-white/10 p-4">
                <div class="flex items-center gap-3 rounded-admin-md px-1 py-1.5">
                    <span class="flex h-9 w-9 flex-none items-center justify-center rounded-full bg-admin-orange text-sm font-extrabold text-admin-sidebar">
                        {{ collect(explode(' ', auth()->user()->name ?? 'Vallen'))->map(fn ($p) => strtoupper($p[0] ?? ''))->take(2)->join('') }}
                    </span>
                    <div class="min-w-0 leading-tight">
                        <p class="truncate text-sm font-bold text-white">{{ auth()->user()->name ?? 'Vallen' }}</p>
                        <p class="text-xs text-white/45">Studio Administrator</p>
                    </div>
                </div>
                <form method="POST" action="{{ route('logout') }}" class="mt-2">
                    @csrf
                    <button type="submit" class="admin-nav-link is-disabled cursor-pointer! w-full text-white/55! hover:bg-white/5! hover:text-white!">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4.5 w-4.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><path d="M16 17l5-5-5-5M21 12H9"/></svg>
                        Logout
                    </button>
                </form>
            </div>
        </aside>

        {{-- ============ MAIN COLUMN ============ --}}
        <div class="flex min-w-0 flex-1 flex-col">

            {{-- ============ TOPBAR ============ --}}
            <header class="sticky top-0 z-30 flex items-center gap-4 border-b border-admin-border bg-admin-card px-5 py-3.5 lg:px-8">
                <button @click="sidebarOpen = true" class="rounded-lg border border-admin-border p-2 text-admin-text lg:hidden" aria-label="Open menu">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/></svg>
                </button>

                <h1 class="hidden text-lg font-extrabold text-admin-text sm:block">@yield('title', 'Dashboard')</h1>

                <div class="relative ml-2 hidden max-w-xs flex-1 md:block">
                    <svg xmlns="http://www.w3.org/2000/svg" class="pointer-events-none absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-admin-muted" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="7"/><path d="m21 21-4.3-4.3"/></svg>
                    <input
                        type="text"
                        placeholder="Search games, devlogs, messages…"
                        disabled
                        class="w-full rounded-full border border-admin-border bg-admin-bg py-2 pl-9 pr-3 text-sm text-admin-text placeholder:text-admin-muted focus:outline-none"
                    >
                </div>

                <div class="ml-auto flex items-center gap-2.5">
                    <button type="button" class="relative rounded-full border border-admin-border p-2 text-admin-muted hover:text-admin-text" aria-label="Notifications">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4.5 w-4.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M18 8a6 6 0 1 0-12 0c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/></svg>
                        <span class="absolute right-1.5 top-1.5 h-2 w-2 rounded-full bg-admin-danger"></span>
                    </button>

                    <a href="{{ route('home') }}" target="_blank" class="hidden items-center gap-2 rounded-full border border-admin-border px-3.5 py-2 text-sm font-semibold text-admin-text hover:bg-admin-bg sm:inline-flex">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><path d="M15 3h6v6M10 14 21 3"/></svg>
                        View Website
                    </a>

                    <span class="flex h-9 w-9 items-center justify-center rounded-full bg-admin-sidebar text-sm font-extrabold text-white">
                        {{ collect(explode(' ', auth()->user()->name ?? 'Vallen'))->map(fn ($p) => strtoupper($p[0] ?? ''))->take(2)->join('') }}
                    </span>
                </div>
            </header>

            <main class="flex-1 px-5 py-6 lg:px-8 lg:py-8">
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>