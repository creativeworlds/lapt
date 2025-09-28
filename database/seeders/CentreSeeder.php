<?php

namespace Database\Seeders;

use App\Models\Centre;
use Illuminate\Database\Seeder;

class CentreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // multiple row create
        $centres = collect([
            [
                'name' => 'Ghaziabad',
                'code' => '201001',
            ],
            [
                'name' => 'Modinagar',
                'code' => '201204',
            ],
            [
                'name' => 'Noida',
                'code' => '201301',
            ]
        ]);

        // Multiple data seeding
        $centres->map(fn($item) => Centre::create($item));
    }
}