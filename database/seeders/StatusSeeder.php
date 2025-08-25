<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = [
            [
                "name" => 'Active',
                'description' => null,
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                "name" => 'Inactive',
                'description' => null,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ];


        foreach ($statuses as $status) {
            DB::table('statuses')->insert([
                'name' => $status['name'],
                'description' => $status['description'],
                'created_at' => $status['created_at'],
                'updated_at' => $status['updated_at']
            ]);
        }
    }
}
