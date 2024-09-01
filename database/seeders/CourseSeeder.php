<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Course;
class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $courses = $courses = [
        ['id' => 1, 'name' => 'WAP'],
        ['id' => 2, 'name' => 'MWA'],
        ['id' => 3, 'name' => 'SE'],
        ['id' => 4, 'name' => 'DBMS'],
    ];

         foreach ($courses as $course) {
            Course::create($course);
        }
    }
}