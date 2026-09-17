@extends('admin.layouts.app')

@section('title', 'Games')

@section('content')

@php
    $statusStyles = [
        'concept' => 'admin-badge-purple',
        'in_development' => 'admin-badge-orange',
        'published' => 'admin-badge-success',
    ];
@endphp

<div class="mx-auto max-w-7xl">

    <div class="mb-6 flex flex-wrap items-center justify-between gap-3">
        <div>
            <h2 class="text-2xl font-extrabold text-admin-text">Games</h2>
            <p class="mt-1 text-sm text-admin-muted">Manage every project in the studio's pipeline.</p>
        </div>
        <a href="{{ route('admin.games.create') }}" class="inline-flex items-center gap-2 rounded-admin-md bg-admin-orange px-4 py-2.5 text-sm font-bold text-admin-sidebar hover:bg-admin-orange-dark">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 5v14M5 12h14"/></svg>
            Add New Game
        </a>
    </div>

    @if(session('status'))
        <div class="mb-5 rounded-admin-md border border-admin-success/30 bg-admin-success-soft px-4 py-3 text-sm font-semibold text-admin-success">
            {{ session('status') }}
        </div>
    @endif

    {{-- Filters --}}
    <form method="GET" class="admin-card mb-5 flex flex-wrap items-center gap-3 p-4">
        <input
            type="text" name="q" value="{{ request('q') }}"
            placeholder="Search by title…"
            class="min-w-[200px] flex-1 rounded-admin-md border border-admin-border bg-admin-bg px-4 py-2 text-sm text-admin-text placeholder:text-admin-muted focus:border-admin-orange focus:outline-none"
        >
        <select name="status" class="rounded-admin-md border border-admin-border bg-admin-bg px-3 py-2 text-sm text-admin-text focus:border-admin-orange focus:outline-none">
            <option value="">All statuses</option>
            @foreach($statuses as $value => $label)
                <option value="{{ $value }}" @selected(request('status') === $value)>{{ $label }}</option>
            @endforeach
        </select>
        <button type="submit" class="rounded-admin-md border border-admin-border px-4 py-2 text-sm font-semibold text-admin-text hover:bg-admin-bg">Filter</button>
        @if(request('q') || request('status'))
            <a href="{{ route('admin.games.index') }}" class="text-sm font-semibold text-admin-muted hover:text-admin-text">Reset</a>
        @endif
    </form>

    <div class="admin-card p-6">
        @if($games->isEmpty())
            <div class="flex flex-col items-center py-14 text-center">
                <span class="flex h-14 w-14 items-center justify-center rounded-full bg-admin-orange/15 text-admin-orange">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="2" y="7" width="20" height="12" rx="4"/><path d="M8 11v4M6 13h4M16 12h.01M18 14h.01"/></svg>
                </span>
                <p class="mt-4 font-semibold text-admin-text">No games yet</p>
                <p class="mt-1 max-w-xs text-sm text-admin-muted">Add your first project to start tracking it here and on the dashboard.</p>
                <a href="{{ route('admin.games.create') }}" class="mt-5 rounded-admin-md bg-admin-orange px-4 py-2.5 text-sm font-bold text-admin-sidebar hover:bg-admin-orange-dark">
                    Add New Game
                </a>
            </div>
        @else
            <div class="admin-scrollbar -mx-6 overflow-x-auto px-6">
                <table class="w-full min-w-140 border-collapse text-sm">
                    <thead>
                        <tr class="border-b border-admin-border text-left text-xs uppercase tracking-wide text-admin-muted">
                            <th class="pb-2.5 font-semibold">Game</th>
                            <th class="pb-2.5 font-semibold">Genre</th>
                            <th class="pb-2.5 font-semibold">Status</th>
                            <th class="pb-2.5 font-semibold">Updated</th>
                            <th class="pb-2.5 font-semibold"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($games as $game)
                            <tr class="border-b border-admin-border/70 last:border-0">
                                <td class="py-3 pr-3">
                                    <div class="flex items-center gap-3">
                                        @if($game->thumbnail)
                                            <img src="{{ asset('storage/'.$game->thumbnail) }}" alt="" class="h-9 w-9 flex-none rounded-admin-md object-cover">
                                        @else
                                            <span class="flex h-9 w-9 flex-none items-center justify-center rounded-admin-md bg-admin-sidebar text-xs font-extrabold text-white">
                                                {{ strtoupper(substr($game->title, 0, 2)) }}
                                            </span>
                                        @endif
                                        <span class="font-semibold text-admin-text">{{ $game->title }}</span>
                                    </div>
                                </td>
                                <td class="py-3 pr-3 text-admin-muted">{{ $game->genre ?: '—' }}</td>
                                <td class="py-3 pr-3">
                                    <span class="admin-badge {{ $statusStyles[$game->status] ?? 'admin-badge-muted' }}">{{ $game->status_label }}</span>
                                </td>
                                <td class="py-3 pr-3 text-admin-muted">{{ $game->updated_at->diffForHumans() }}</td>
                                <td class="py-3 text-right">
                                    <div class="flex items-center justify-end gap-3">
                                        <a href="{{ route('admin.games.edit', $game) }}" class="text-xs font-semibold text-admin-text hover:text-admin-orange-dark">Edit</a>
                                        <form method="POST" action="{{ route('admin.games.destroy', $game) }}" onsubmit="return confirm('Delete {{ $game->title }}? This cannot be undone.');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-xs font-semibold text-admin-danger hover:underline">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-5">
                {{ $games->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
