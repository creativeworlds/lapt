<?php

namespace Database\Seeders;

use App\Models\CourseStudent;
use Illuminate\Database\Seeder;

class CourseStudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // multiple row create
        $courseStudents = collect([
            [
                'course_id' => 1,
                'student_id' => 1,
            ],
            [
                'course_id' => 2,
                'student_id' => 2,
            ],
            [
                'course_id' => 3,
                'student_id' => 3,
            ],
        ]);

        // Multiple data seeding
        $courseStudents->map(fn($item) => CourseStudent::create($item));
    }
}