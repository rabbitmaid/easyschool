<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         Admin::firstOrCreate([
            'username' => 'adminuser',
            'email' => 'admin@email.com',
            'password' => Hash::make('password'), // Always hash passwords
            'course_id' => 1,
            'status_id' => 1,
            'gender_id' => 1,
            'date_of_birth' => '1995-05-20',
            'role_id' => 1 // e.g., 1 = Super Admin
        ]);
    }
}
