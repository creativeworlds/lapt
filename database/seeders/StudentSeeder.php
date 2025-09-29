<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // multiple row create
        $students = collect([
            [
                'name' => 'Student 1',
                'email' => 'student1@lapt.org',
                'phone_number' => '9876543210',
                'centre_id'=> 1,
            ],
            [
                'name' => 'Student 2',
                'email' => 'student2@lapt.org',
                'phone_number' => '9876123450',
                'centre_id'=> 1,
            ],
            [
                'name' => 'Student 3',
                'email' => 'student3@lapt.org',
                'phone_number' => '1234560987',
                'centre_id'=> 1,
            ]
        ]);

        // Multiple data seeding
        $students->map(fn($item) => Student::create($item));
    }
}