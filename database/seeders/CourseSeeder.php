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
            ]
        ]);

        // Multiple data seeding
        $courses->map(fn($item) => Course::create($item));
    }
}