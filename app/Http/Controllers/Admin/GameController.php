<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Game;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class GameController extends Controller
{
    public function index(Request $request): View
    {
        $games = Game::query()
            ->when($request->filled('q'), fn ($q) => $q->where('title', 'like', '%'.$request->string('q').'%'))
            ->when($request->filled('status'), fn ($q) => $q->where('status', $request->string('status')))
            ->latest('updated_at')
            ->paginate(10)
            ->withQueryString();

        return view('admin.games.index', [
            'games' => $games,
            'statuses' => Game::STATUSES,
        ]);
    }

    public function create(): View
    {
        return view('admin.games.create', [
            'statuses' => Game::STATUSES,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validated($request);

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('games', 'public');
        }

        Game::create($data);

        return redirect()
            ->route('admin.games.index')
            ->with('status', 'Game created.');
    }

    public function edit(Game $game): View
    {
        return view('admin.games.edit', [
            'game' => $game,
            'statuses' => Game::STATUSES,
        ]);
    }

    public function update(Request $request, Game $game): RedirectResponse
    {
        $data = $this->validated($request, $game->id);

        if ($request->hasFile('thumbnail')) {
            if ($game->thumbnail) {
                Storage::disk('public')->delete($game->thumbnail);
            }
            $data['thumbnail'] = $request->file('thumbnail')->store('games', 'public');
        }

        $game->update($data);

        return redirect()
            ->route('admin.games.index')
            ->with('status', 'Game updated.');
    }

    public function destroy(Game $game): RedirectResponse
    {
        if ($game->thumbnail) {
            Storage::disk('public')->delete($game->thumbnail);
        }

        $game->delete();

        return redirect()
            ->route('admin.games.index')
            ->with('status', 'Game deleted.');
    }

    private function validated(Request $request, ?int $ignoreId = null): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'genre' => ['nullable', 'string', 'max:255'],
            'status' => ['required', 'in:concept,in_development,published'],
            'description' => ['nullable', 'string', 'max:2000'],
            'release_date' => ['nullable', 'date'],
            'thumbnail' => ['nullable', 'image', 'max:2048'],
        ]);
    }
}
