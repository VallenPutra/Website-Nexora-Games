@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')

@php
    $maxRevenue = collect($revenue)->max('value') ?: 1;

    $statusStyles = [
        'In Development' => 'admin-badge-orange',
        'Published' => 'admin-badge-success',
        'Concept' => 'admin-badge-purple',
        'Active' => 'admin-badge-success',
        'Review' => 'admin-badge-orange',
    ];

    $activityIcons = [
        'update' => ['bg' => 'bg-admin-orange/15', 'text' => 'text-admin-orange-dark'],
        'devlog' => ['bg' => 'bg-admin-purple-soft', 'text' => 'text-admin-purple'],
        'media' => ['bg' => 'bg-admin-success-soft', 'text' => 'text-admin-success'],
        'message' => ['bg' => 'bg-admin-danger-soft', 'text' => 'text-admin-danger'],
    ];
@endphp

<div class="mx-auto max-w-7xl">

    {{-- ============ DEMO DATA NOTICE ============ --}}
    @if($isDemoData)
        <div class="mb-6 flex items-start gap-2.5 rounded-admin-md border border-admin-orange/30 bg-admin-orange/10 px-4 py-3 text-sm text-admin-orange-dark">
            <svg xmlns="http://www.w3.org/2000/svg" class="mt-0.5 h-4 w-4 flex-none" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 9v4M12 17h.01"/><circle cx="12" cy="12" r="9"/></svg>
            <p><strong>Demo data.</strong> Games, Devlogs, and Messages models don't exist in the database yet, so every number below is sample content for layout purposes — not real studio data.</p>
        </div>
    @endif

    {{-- ============ 1. WELCOME HEADER ============ --}}
    <div class="mb-7 flex flex-wrap items-end justify-between gap-3">
        <div>
            <h2 class="text-2xl font-extrabold text-admin-text sm:text-[28px]">Good morning, {{ auth()->user()->name ?? 'Vallen' }}.</h2>
            <p class="mt-1 text-sm text-admin-muted">Here's what's happening in your studio today.</p>
        </div>
        <span class="admin-badge admin-badge-muted font-mono">{{ now()->format('D, d M Y') }}</span>
    </div>

    {{-- ============ 2. STATISTICS ============ --}}
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">
        @foreach($stats as $stat)
            <div class="admin-card p-5">
                <div class="flex items-center justify-between">
                    <span class="flex h-10 w-10 items-center justify-center rounded-admin-md bg-admin-orange/15 text-admin-orange-dark">
                        @switch($stat['icon'])
                            @case('games')
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="2" y="7" width="20" height="12" rx="4"/><path d="M8 11v4M6 13h4M16 12h.01M18 14h.01"/></svg>
                                @break
                            @case('devlog')
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M4 4h13l3 3v13H4Z"/><path d="M8 9h8M8 13h8M8 17h5"/></svg>
                                @break
                            @case('draft')
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M12 20h9M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4Z"/></svg>
                                @break
                            @default
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="m3 7 9 6 9-6"/></svg>
                        @endswitch
                    </span>
                </div>
                <p class="mt-4 text-3xl font-extrabold text-admin-text">{{ $stat['value'] }}</p>
                <p class="mt-1 text-sm font-semibold text-admin-text">{{ $stat['label'] }}</p>
                <p class="mt-0.5 text-xs text-admin-muted">{{ $stat['hint'] }}</p>
            </div>
        @endforeach
    </div>

    <div class="mt-6 grid grid-cols-1 gap-6 xl:grid-cols-3">

        {{-- ============ 3. MONTHLY REVENUE ============ --}}
        <div class="admin-card p-6 xl:col-span-2">
            <div class="flex flex-wrap items-start justify-between gap-2">
                <div>
                    <h3 class="text-base font-bold text-admin-text">Monthly Revenue</h3>
                    <p class="text-xs text-admin-muted">Sample data — connect a Sale/Order model for real figures.</p>
                </div>
                <span class="admin-badge admin-badge-orange">Demo</span>
            </div>

            <div class="mt-6 flex h-48 items-end gap-3 sm:gap-5">
                @foreach($revenue as $point)
                    @php $heightPct = max(6, round(($point['value'] / $maxRevenue) * 100)); @endphp
                    <div class="flex flex-1 flex-col items-center gap-2">
                        <span class="text-xs font-semibold text-admin-muted">Rp{{ $point['value'] }}jt</span>
                        <div class="flex h-32 w-full items-end rounded-t-admin-md bg-admin-bg">
                            <div class="w-full rounded-t-admin-md bg-admin-orange" style="height: {{ $heightPct }}%"></div>
                        </div>
                        <span class="font-mono text-[11px] text-admin-muted">{{ $point['label'] }}</span>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- ============ 6. QUICK ACTIONS ============ --}}
        <div class="admin-card p-6">
            <h3 class="text-base font-bold text-admin-text">Quick Actions</h3>
            <div class="mt-4 flex flex-col gap-2.5">
                <button type="button" disabled class="flex items-center gap-3 rounded-admin-md border border-admin-border px-3.5 py-3 text-left text-sm font-semibold text-admin-muted">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 flex-none" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 5v14M5 12h14"/></svg>
                    Add New Game
                    <span class="ml-auto rounded-full bg-admin-bg px-2 py-0.5 font-mono text-[10px]">Soon</span>
                </button>
                <button type="button" disabled class="flex items-center gap-3 rounded-admin-md border border-admin-border px-3.5 py-3 text-left text-sm font-semibold text-admin-muted">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 flex-none" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 20h9M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4Z"/></svg>
                    Write Devlog
                    <span class="ml-auto rounded-full bg-admin-bg px-2 py-0.5 font-mono text-[10px]">Soon</span>
                </button>
                <button type="button" disabled class="flex items-center gap-3 rounded-admin-md border border-admin-border px-3.5 py-3 text-left text-sm font-semibold text-admin-muted">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 flex-none" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="9" cy="10" r="2"/><path d="m21 15-5-5-9 9"/></svg>
                    Upload Media
                    <span class="ml-auto rounded-full bg-admin-bg px-2 py-0.5 font-mono text-[10px]">Soon</span>
                </button>
                <a href="{{ route('home') }}" target="_blank" class="flex items-center gap-3 rounded-admin-md border border-admin-orange bg-admin-orange/10 px-3.5 py-3 text-left text-sm font-semibold text-admin-orange-dark transition-colors hover:bg-admin-orange/20">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 flex-none" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><path d="M15 3h6v6M10 14 21 3"/></svg>
                    View Public Website
                </a>
            </div>
        </div>
    </div>

    <div class="mt-6 grid grid-cols-1 gap-6 xl:grid-cols-3">

        {{-- ============ 4. RECENT PROJECTS ============ --}}
        <div class="admin-card p-6 xl:col-span-2">
            <div class="flex items-center justify-between">
                <h3 class="text-base font-bold text-admin-text">Recent Projects</h3>
                <button type="button" disabled class="text-xs font-semibold text-admin-muted">View All Games →</button>
            </div>

            <div class="admin-scrollbar mt-4 -mx-6 overflow-x-auto px-6">
                <table class="w-full min-w-130 border-collapse text-sm">
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
                        @foreach($recentProjects as $project)
                            <tr class="border-b border-admin-border/70 last:border-0">
                                <td class="py-3 pr-3">
                                    <div class="flex items-center gap-3">
                                        <span class="flex h-9 w-9 flex-none items-center justify-center rounded-admin-md bg-admin-sidebar text-xs font-extrabold text-white">
                                            {{ strtoupper(substr($project['title'], 0, 2)) }}
                                        </span>
                                        <span class="font-semibold text-admin-text">{{ $project['title'] }}</span>
                                    </div>
                                </td>
                                <td class="py-3 pr-3 text-admin-muted">{{ $project['genre'] }}</td>
                                <td class="py-3 pr-3">
                                    <span class="admin-badge {{ $statusStyles[$project['status']] ?? 'admin-badge-muted' }}">{{ $project['status'] }}</span>
                                </td>
                                <td class="py-3 pr-3 text-admin-muted">{{ $project['updated'] }}</td>
                                <td class="py-3 text-right">
                                    <button type="button" disabled class="text-xs font-semibold text-admin-muted">Manage</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- ============ 7. RECENT ACTIVITY ============ --}}
        <div class="admin-card p-6">
            <h3 class="text-base font-bold text-admin-text">Recent Activity</h3>
            <ul class="mt-4 flex flex-col gap-4">
                @foreach($recentActivity as $item)
                    @php $ic = $activityIcons[$item['type']] ?? ['bg' => 'bg-admin-bg', 'text' => 'text-admin-muted']; @endphp
                    <li class="flex gap-3">
                        <span class="mt-0.5 flex h-7 w-7 flex-none items-center justify-center rounded-full {{ $ic['bg'] }} {{ $ic['text'] }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="currentColor"><circle cx="12" cy="12" r="5"/></svg>
                        </span>
                        <div class="min-w-0">
                            <p class="text-sm text-admin-text">{{ $item['text'] }}</p>
                            <p class="mt-0.5 text-xs text-admin-muted">{{ $item['time'] }}</p>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    {{-- ============ 5. STUDIO ACTIVITY / TEAM WORKSPACE ============ --}}
    <div class="admin-card mt-6 p-6">
        <div class="flex items-center justify-between">
            <h3 class="text-base font-bold text-admin-text">Studio Activity</h3>
            <span class="text-xs text-admin-muted">Fictional demo team &mdash; for layout purposes only</span>
        </div>

        <div class="admin-scrollbar mt-4 -mx-6 overflow-x-auto px-6">
            <table class="w-full min-w-140 border-collapse text-sm">
                <thead>
                    <tr class="border-b border-admin-border text-left text-xs uppercase tracking-wide text-admin-muted">
                        <th class="pb-2.5 font-semibold">Activity</th>
                        <th class="pb-2.5 font-semibold">Team</th>
                        <th class="pb-2.5 font-semibold">Status</th>
                        <th class="pb-2.5 font-semibold">Last Update</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($studioActivity as $row)
                        <tr class="border-b border-admin-border/70 last:border-0">
                            <td class="py-3 pr-3 font-semibold text-admin-text">{{ $row['activity'] }}</td>
                            <td class="py-3 pr-3 text-admin-muted">{{ $row['owner'] }}</td>
                            <td class="py-3 pr-3">
                                <span class="admin-badge {{ $statusStyles[$row['status']] ?? 'admin-badge-muted' }}">{{ $row['status'] }}</span>
                            </td>
                            <td class="py-3 text-admin-muted">{{ $row['time'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
