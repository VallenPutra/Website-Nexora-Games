<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Seed the studio administrator account used to log into /admin.
     *
     * Uses updateOrCreate() keyed by email so this seeder is safe to run
     * more than once (php artisan db:seed) without creating duplicates
     * or throwing a unique-constraint error.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'vallen@nexoragames.com'],
            [
                'name' => 'Vallen',
                'password' => Hash::make('password'), // ⚠️ change this after first login
                'email_verified_at' => now(),
            ]
        );
    }
}
