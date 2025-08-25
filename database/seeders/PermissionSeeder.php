<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            ['name' => '', 'description' => '', 'created_at' => now(), 'updated_at' => now()]
        ];

        foreach($permissions as $permission)
        {
            DB::table('permissions')->insert([
                'name' => $permission['name'],
                'description' => $permission['description'],
                'created_at' => $permission['created_at'],
                'updated_at' => $permission['updated_at']
            ]);
        }
    }
}
