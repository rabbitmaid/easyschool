<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $roles = [
            [
                "name" => 'SuperAdmin',
                'description' => null,
                'status_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                "name" => 'Administrator',
                'description' => null,
                'status_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                "name" => 'Teacher',
                'description' => null,
                'status_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];


        foreach ($roles as $role) {
            DB::table('roles')->insert([
                'name' => $role['name'],
                'description' => $role['description'],
                'status_id' => $role['status_id'],
                'created_at' => $role['created_at'],
                'updated_at' => $role['updated_at']
            ]);
        }
    }
}
