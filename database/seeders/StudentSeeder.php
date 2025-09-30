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
        // create a student
        $student = [
            'centre_id' => 1,
            'course_id' => 1,
            'name' => 'John Doe',
            'care_of' => 'Jane Doe',
            'sex' => 'male',
            'session' => '2025-A',
            'photo'=> '',
            'id_card' => '',
            'education_proof' => '',
            'other_doc' => '',
            'qualification' => 'B.A.',
            'telephone' => '',
            'email' => 'john@example.com',
            'mobile' => '9876543210',
            'fax' => '',
            'address_line' => '123 Main Street, New Delhi',
            'details' => 'Sample student enrolled in 2025 batch.',
            'password' => '',
        ];

        // Multiple data seeding
        Student::create($student);
    }
}