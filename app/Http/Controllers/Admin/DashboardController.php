<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;

class DashboardController extends Controller
{
    /**
     * Show the admin dashboard overview.
     *
     * NOTE — DEMO DATA:
     * This project does not yet have Game, Devlog, or Message models/tables
     * (only the default `users` table exists). Every array below is clearly
     * marked demo/sample content so it is never mistaken for real production
     * numbers. Once the corresponding models & migrations are created, swap
     * each block for a real Eloquent query — the Blade view does not need to
     * change, only the data passed into it.
     */
    public function index(): View
    {
        $stats = $this->demoStats();
        $revenue = $this->demoRevenue();
        $recentProjects = $this->demoRecentProjects();
        $studioActivity = $this->demoStudioActivity();
        $recentActivity = $this->demoRecentActivity();

        return view('admin.dashboard', [
            'stats' => $stats,
            'revenue' => $revenue,
            'recentProjects' => $recentProjects,
            'studioActivity' => $studioActivity,
            'recentActivity' => $recentActivity,
            'isDemoData' => true,
        ]);
    }

    /**
     * DEMO DATA — replace with real counts once Game / Devlog / Message
     * models exist, e.g.:
     *   'value' => \App\Models\Game::count(),
     */
    private function demoStats(): array
    {
        return [
            [
                'label' => 'Total Games',
                'value' => 3,
                'hint' => '3 projects in the pipeline',
                'icon' => 'games',
            ],
            [
                'label' => 'Published Devlogs',
                'value' => 12,
                'hint' => '3 posts this month',
                'icon' => 'devlog',
            ],
            [
                'label' => 'Draft Projects',
                'value' => 2,
                'hint' => 'Awaiting review',
                'icon' => 'draft',
            ],
            [
                'label' => 'Unread Messages',
                'value' => 5,
                'hint' => 'From the contact page',
                'icon' => 'messages',
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
     * DEMO DATA — fictional project rows. Replace with
     * \App\Models\Game::latest()->take(4)->get() once that model exists.
     */
    private function demoRecentProjects(): array
    {
        return [
            [
                'title' => 'Pixelbound',
                'genre' => 'Adventure Platformer',
                'status' => 'In Development',
                'updated' => '2 days ago',
            ],
            [
                'title' => 'Moonberry',
                'genre' => 'Cozy Adventure',
                'status' => 'Concept',
                'updated' => '5 days ago',
            ],
            [
                'title' => 'Starforge',
                'genre' => 'Pixel Action RPG',
                'status' => 'In Development',
                'updated' => '1 week ago',
            ],
        ];
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
