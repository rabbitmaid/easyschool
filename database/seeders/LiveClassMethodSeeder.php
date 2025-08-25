<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class LiveClassMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $live_class_methods = [
            ['name' => 'Google Meet', 'description' => null , 'status_id' => 1 , 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Zoom', 'description' => null, 'status_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Onpassive', 'description' => null,  'status_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        ];

        foreach($live_class_methods as $live_class_method)
        {
            DB::table('live_class_methods')->insert([
                'name' => $live_class_method['name'],
                'description' => $live_class_method['description'],
                'status_id' => $live_class_method['status_id'],
                'created_at' => $live_class_method['created_at'],
                'updated_at' => $live_class_method['updated_at']
            ]);
        }
    }
}
