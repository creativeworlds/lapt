<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // multiple row create
        $users = collect([
            [
                'name' => 'Pramod Singh',
                'email' => 'pramod@lapt.org',
                'password' => 'password',
            ]
        ]);

        // Multiple data seeding
        $users->map(fn($item) => User::create($item));
    }
}