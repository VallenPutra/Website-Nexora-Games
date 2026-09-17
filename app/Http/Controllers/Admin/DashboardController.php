<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactSubmission;
use App\Models\Game;
use Illuminate\Contracts\View\View;

class DashboardController extends Controller
{
    /**
     * Show the admin dashboard overview.
     *
     * DATA STATUS:
     * - Games: REAL — the `games` table/model exists, so Total Games,
     *   Draft Projects, and Recent Projects are live queries.
     * - Messages: REAL — the `contact_submissions` table/model exists,
     *   so Unread Messages is a live query (read_at IS NULL).
     * - Devlogs, Revenue, Studio Activity, Recent Activity: still DEMO
     *   data — those models/tables don't exist yet. Each demo array
     *   below is clearly commented and flagged so it's never mistaken
     *   for production data.
     */
    public function index(): View
    {
        $stats = $this->stats();
        $revenue = $this->demoRevenue();
        $recentProjects = $this->recentProjects();
        $studioActivity = $this->demoStudioActivity();
        $recentActivity = $this->demoRecentActivity();

        return view('admin.dashboard', [
            'stats' => $stats,
            'revenue' => $revenue,
            'recentProjects' => $recentProjects,
            'studioActivity' => $studioActivity,
            'recentActivity' => $recentActivity,
            // Still true because Devlogs/Revenue/Activity below remain
            // demo content — shown in the banner on the view.
            'isDemoData' => true,
        ]);
    }

    /**
     * Total Games, Draft Projects & Unread Messages are REAL, queried
     * from the `games` and `contact_submissions` tables. Published
     * Devlogs stays DEMO until a Devlog model exists.
     */
    private function stats(): array
    {
        $totalGames = Game::count();
        $draftGames = Game::where('status', 'concept')->count();
        $unreadMessages = ContactSubmission::whereNull('read_at')->count();

        return [
            [
                'label' => 'Total Games',
                'value' => $totalGames,
                'hint' => $totalGames === 1 ? '1 project in the pipeline' : "{$totalGames} projects in the pipeline",
                'icon' => 'games',
                'demo' => false,
            ],
            [
                'label' => 'Published Devlogs',
                'value' => 12,
                'hint' => '3 posts this month',
                'icon' => 'devlog',
                'demo' => true, // DEMO — no Devlog model yet
            ],
            [
                'label' => 'Draft Projects',
                'value' => $draftGames,
                'hint' => 'Games marked as "Concept"',
                'icon' => 'draft',
                'demo' => false,
            ],
            [
                'label' => 'Unread Messages',
                'value' => $unreadMessages,
                'hint' => 'From the contact page',
                'icon' => 'messages',
                'demo' => false,
            ],
        ];
    }

    /**
     * DEMO DATA — sample monthly revenue for chart layout purposes only.
     * Replace with a real query once a Sale/Order/Revenue model exists,
     * e.g. grouped by month via ->selectRaw('MONTH(created_at) ...').
     * This is NOT the studio's actual revenue.
     */
    private function demoRevenue(): array
    {
        return [
            ['label' => 'Apr', 'value' => 4.2],
            ['label' => 'May', 'value' => 5.1],
            ['label' => 'Jun', 'value' => 4.8],
            ['label' => 'Jul', 'value' => 6.4],
            ['label' => 'Aug', 'value' => 7.9],
            ['label' => 'Sep', 'value' => 7.1],
        ];
    }

    /**
     * REAL DATA — latest games from the database. Returns an empty
     * collection (not fabricated rows) when no games have been added yet;
     * the Blade view renders an empty state in that case.
     */
    private function recentProjects()
    {
        return Game::latest('updated_at')
            ->take(4)
            ->get()
            ->map(fn (Game $game) => [
                'id' => $game->id,
                'title' => $game->title,
                'genre' => $game->genre ?: '—',
                'status' => $game->status_label,
                'updated' => $game->updated_at->diffForHumans(),
            ]);
    }

    /**
     * DEMO DATA — fictional studio activity feed. Team member names are
     * placeholders and do not represent real people.
     */
    private function demoStudioActivity(): array
    {
        return [
            [
                'activity' => 'Pixelbound — Level Design',
                'owner' => 'Art Team',
                'status' => 'Active',
                'time' => '20 min ago',
            ],
            [
                'activity' => 'Moonberry — Character Art',
                'owner' => 'Art Team',
                'status' => 'Active',
                'time' => '1 hr ago',
            ],
            [
                'activity' => 'Starforge — Prototype Testing',
                'owner' => 'Dev Team',
                'status' => 'Review',
                'time' => '3 hr ago',
            ],
            [
                'activity' => 'Studio Website — Content Update',
                'owner' => 'Studio Admin',
                'status' => 'Active',
                'time' => 'Today',
            ],
        ];
    }

    /**
     * DEMO DATA — fictional recent activity timeline.
     */
    private function demoRecentActivity(): array
    {
        return [
            [
                'text' => 'Pixelbound project details were updated.',
                'time' => '20 minutes ago',
                'type' => 'update',
            ],
            [
                'text' => 'New devlog draft created: "From Sprite Sheet to Playable Game."',
                'time' => '2 hours ago',
                'type' => 'devlog',
            ],
            [
                'text' => '3 new media files uploaded to the library.',
                'time' => '5 hours ago',
                'type' => 'media',
            ],
            [
                'text' => 'New contact message received via the contact page.',
                'time' => 'Yesterday',
                'type' => 'message',
            ],
        ];
    }
}
