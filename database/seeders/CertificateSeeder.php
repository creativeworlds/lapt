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
                'course_id' => 1,
                'student_id' => 1,
            ]
        ]);

        // Multiple data seeding
        $certificates->map(fn($item) => Certificate::create($item));
    }
}