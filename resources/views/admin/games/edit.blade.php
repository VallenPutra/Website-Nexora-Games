@extends('admin.layouts.app')

@section('title', 'Edit Game')

@section('content')
<div class="mx-auto max-w-7xl">

    <div class="mb-6 flex items-center gap-3">
        <a href="{{ route('admin.games.index') }}" class="rounded-admin-md border border-admin-border p-2 text-admin-text hover:bg-admin-bg">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
        </a>
        <div>
            <h2 class="text-2xl font-extrabold text-admin-text">Edit {{ $game->title }}</h2>
            <p class="mt-1 text-sm text-admin-muted">Last updated {{ $game->updated_at->diffForHumans() }}.</p>
        </div>
    </div>

    <form method="POST" action="{{ route('admin.games.update', $game) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        @include('admin.games._form')

        <div class="mt-6 flex items-center gap-3">
            <button type="submit" class="rounded-admin-md bg-admin-orange px-5 py-2.5 text-sm font-bold text-admin-sidebar hover:bg-admin-orange-dark">
                Save Changes
            </button>
            <a href="{{ route('admin.games.index') }}" class="text-sm font-semibold text-admin-muted hover:text-admin-text">Cancel</a>
        </div>
    </form>
</div>
@endsection
