<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * Note: the admin panel authenticates against the `admins` table
     * (App\Models\backend\Admins), not Laravel's default `users` table,
     * so nothing is seeded there by default. Uncomment below if you want
     * some sample rooms to look at.
     */
    public function run(): void
    {
        // $this->call(DummyRoomSeeder::class);
    }
}
