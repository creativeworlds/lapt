<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // multiple row create
        $courses = collect([
            [
                'centre_id' => 1,
                'name' => 'BCA',
                'code' => '001001',
            ],
            [
                'centre_id' => 2,
                'name' => 'B.sc',
                'code' => '002003',
            ],
            [
                'centre_id' => 3,
                'name' => 'B.A.',
                'code' => '908678',
            ]
        ]);

        // Multiple data seeding
        $courses->map(fn($item) => Course::create($item));
    }
}