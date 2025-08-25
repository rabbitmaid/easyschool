<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class GenderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $genders = [
            [
                "name" => 'Male',
                'description' => null,
                'status_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                "name" => 'Female',
                'description' => null,
                'status_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                "name" => 'Other',
                'description' => null,
                'status_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];


        foreach ($genders as $gender) {
            DB::table('genders')->insert([
                'name' => $gender['name'],
                'description' => $gender['description'],
                'status_id' => $gender['status_id'],
                'created_at' => $gender['created_at'],
                'updated_at' => $gender['updated_at']
            ]);
        }
    }
}
