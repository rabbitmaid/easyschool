<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\LevelSeeder;
use Database\Seeders\CourseSeeder;
use Database\Seeders\OptionSeeder;
use Database\Seeders\StatusSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        
        $this->call(StatusSeeder::class);
        $this->call(GenderSeeder::class);
        $this->call(LevelSeeder::class);
        $this->call(OptionSeeder::class);
        $this->call(CourseSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(LiveClassMethodSeeder::class);
    }
}
