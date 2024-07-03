<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TalentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('talents')->insert([
            [
                'name' => 'Indrawan Nugroho',
                'talent_image' => 'nugroho.jpeg',
                'talent_description' => 'pinter',
                'event_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sasto wijoyo Nugroho',
                'talent_image' => 'nugroho.jpeg',
                'talent_description' => 'pinter bgt',
                'event_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
