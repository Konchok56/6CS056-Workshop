<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Student;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database with some sample data.
     */
    public function run(): void
    {
        $students = [
            ['name' => 'Aarav Shrestha', 'email' => 'aarav@example.com', 'phone' => '9801234567', 'address' => 'Kathmandu', 'date_of_birth' => '2003-04-12'],
            ['name' => 'Sita Tamang', 'email' => 'sita@example.com', 'phone' => '9812345678', 'address' => 'Lalitpur', 'date_of_birth' => '2002-09-30'],
            ['name' => 'Bikash Rai', 'email' => 'bikash@example.com', 'phone' => '9823456789', 'address' => 'Bhaktapur', 'date_of_birth' => '2004-01-05'],
        ];

        foreach ($students as $student) {
            Student::create($student);
        }

        $courses = [
            ['name' => 'Web Development with Laravel', 'description' => 'Build web applications using PHP and Laravel.', 'duration' => 12, 'fee' => 25000, 'difficulty' => 'Medium', 'is_active' => true],
            ['name' => 'Python for Beginners', 'description' => 'Learn programming from scratch with Python.', 'duration' => 8, 'fee' => 15000, 'difficulty' => 'Easy', 'is_active' => true],
            ['name' => 'Cloud and DevOps', 'description' => 'Deploy and manage applications in the cloud.', 'duration' => 10, 'fee' => 30000, 'difficulty' => 'Hard', 'is_active' => false],
        ];

        foreach ($courses as $course) {
            Course::create($course);
        }
    }
}
