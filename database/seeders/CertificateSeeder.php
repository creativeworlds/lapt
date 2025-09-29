<?php

namespace Database\Seeders;

use App\Models\Certificate;
use Illuminate\Database\Seeder;

class CertificateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // multiple row create
        $certificates = collect([
            [
                'student_id' => 1,
                'course_id' => 1,
                'status' => 'pass',
                'Grade' => 'A',
            ],
            [
                'student_id' => 2,
                'course_id' => 2,
                'status' => 'fail',
                'Grade' => 'D',
            ],
            [
                'student_id' => 3,
                'course_id' => 3,
                'status' => 'pass',
                'Grade' => 'B',
            ]
        ]);

        // Multiple data seeding
        $certificates->map(fn($item) => Certificate::create($item));
    }
}