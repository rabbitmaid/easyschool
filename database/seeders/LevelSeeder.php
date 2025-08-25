<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $classes = [
            [
                "name" => 'Undefined',
                'description' => null,
                'status_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                "name" => 'Class 1',
                'description' => 'This is class is for students of class 1',
                'status_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                "name" => 'Class 2',
                'description' => 'This is class is for students of class 2',
                'status_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];


        foreach ($classes as $class) {
            DB::table('classes')->insert([
                'name' => $class['name'],
                'description' => $class['description'],
                'status_id' => $class['status_id'],
                'created_at' => $class['created_at'],
                'updated_at' => $class['updated_at']
            ]);
        }
    }
}
