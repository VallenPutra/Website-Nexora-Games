@php
    $game = $game ?? null;
@endphp

<div class="grid grid-cols-1 gap-6 lg:grid-cols-3">

    <div class="admin-card space-y-5 p-6 lg:col-span-2">
        <div>
            <label for="title" class="mb-1.5 block text-xs font-bold uppercase tracking-wide text-admin-muted">Title *</label>
            <input
                type="text" id="title" name="title" required
                value="{{ old('title', $game->title ?? '') }}"
                placeholder="e.g. Pixelbound"
                class="w-full rounded-admin-md border border-admin-border bg-admin-bg px-4 py-2.5 text-sm text-admin-text placeholder:text-admin-muted focus:border-admin-orange focus:outline-none"
            >
            @error('title') <p class="mt-1.5 text-xs font-semibold text-admin-danger">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="genre" class="mb-1.5 block text-xs font-bold uppercase tracking-wide text-admin-muted">Genre</label>
            <input
                type="text" id="genre" name="genre"
                value="{{ old('genre', $game->genre ?? '') }}"
                placeholder="e.g. Adventure Platformer"
                class="w-full rounded-admin-md border border-admin-border bg-admin-bg px-4 py-2.5 text-sm text-admin-text placeholder:text-admin-muted focus:border-admin-orange focus:outline-none"
            >
            @error('genre') <p class="mt-1.5 text-xs font-semibold text-admin-danger">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="description" class="mb-1.5 block text-xs font-bold uppercase tracking-wide text-admin-muted">Description</label>
            <textarea
                id="description" name="description" rows="5"
                placeholder="Short description shown on the public games page…"
                class="w-full rounded-admin-md border border-admin-border bg-admin-bg px-4 py-2.5 text-sm text-admin-text placeholder:text-admin-muted focus:border-admin-orange focus:outline-none"
            >{{ old('description', $game->description ?? '') }}</textarea>
            @error('description') <p class="mt-1.5 text-xs font-semibold text-admin-danger">{{ $message }}</p> @enderror
        </div>
    </div>

    <div class="space-y-6">
        <div class="admin-card space-y-5 p-6">
            <div>
                <label for="status" class="mb-1.5 block text-xs font-bold uppercase tracking-wide text-admin-muted">Status *</label>
                <select
                    id="status" name="status" required
                    class="w-full rounded-admin-md border border-admin-border bg-admin-bg px-4 py-2.5 text-sm text-admin-text focus:border-admin-orange focus:outline-none"
                >
                    @foreach($statuses as $value => $label)
                        <option value="{{ $value }}" @selected(old('status', $game->status ?? 'concept') === $value)>{{ $label }}</option>
                    @endforeach
                </select>
                @error('status') <p class="mt-1.5 text-xs font-semibold text-admin-danger">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="release_date" class="mb-1.5 block text-xs font-bold uppercase tracking-wide text-admin-muted">Release Date</label>
                <input
                    type="date" id="release_date" name="release_date"
                    value="{{ old('release_date', optional($game->release_date ?? null)->format('Y-m-d')) }}"
                    class="w-full rounded-admin-md border border-admin-border bg-admin-bg px-4 py-2.5 text-sm text-admin-text focus:border-admin-orange focus:outline-none"
                >
                @error('release_date') <p class="mt-1.5 text-xs font-semibold text-admin-danger">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="admin-card space-y-3 p-6">
            <label for="thumbnail" class="block text-xs font-bold uppercase tracking-wide text-admin-muted">Thumbnail</label>

            @if(($game->thumbnail ?? null))
                <img src="{{ asset('storage/'.$game->thumbnail) }}" alt="" class="h-32 w-full rounded-admin-md object-cover">
                <p class="text-xs text-admin-muted">Uploading a new image will replace this one.</p>
            @endif

            <input
                type="file" id="thumbnail" name="thumbnail" accept="image/*"
                class="w-full rounded-admin-md border border-admin-border bg-admin-bg px-3 py-2 text-sm text-admin-text file:mr-3 file:rounded-full file:border-0 file:bg-admin-orange/15 file:px-3 file:py-1.5 file:text-xs file:font-semibold file:text-admin-orange-dark"
            >
            @error('thumbnail') <p class="mt-1.5 text-xs font-semibold text-admin-danger">{{ $message }}</p> @enderror
        </div>
    </div>
</div>
