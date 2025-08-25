<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $courses = [
            [
                "name" => 'Undefined',
                'description' => null,
                "class_id" => 1,
                'status_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
             "name" => 'English Literature',
             'description' => null,
             "class_id" => 2,
             'status_id' => 1,
             'created_at' => now(),
             'updated_at' => now()
            ],
 
            [
             "name" => 'Mathematics',
             'description' => null,
             "class_id" => 3,
             'status_id' => 1,
             'created_at' => now(),
             'updated_at' => now()
            ]
         ];


         foreach($courses as $course)
        {
            DB::table('courses')->insert([
                'name' => $course['name'],
                'description' => $course['description'],
                "class_id" => $course['class_id'],
                'status_id' => $course['status_id'],
                'created_at' => $course['created_at'],
                'updated_at' => $course['updated_at']
            ]);
        }
    }
}
