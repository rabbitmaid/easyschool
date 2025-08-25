<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class OptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $options = [
            ['name' => 'site_title', 'value' => 'EasySchool', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'site_tag', 'value' => 'The best school Management System', 'created_at' => now(), 'updated_at' => now()]
        ];

        foreach($options as $option)
        {
            DB::table('options')->insert([
                'name' => $option['name'],
                'value' => $option['value'],
                'created_at' => $option['created_at'],
                'updated_at' => $option['updated_at']
            ]);
        }
    }
}
