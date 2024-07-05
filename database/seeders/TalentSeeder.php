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
                'name' => 'Dikta',
                'talent_image' => 'null',
                'talent_description' => 'null',
                'event_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Gildcoustic',
                'talent_image' => 'null',
                'talent_description' => 'null',
                'event_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Pagiboeta',
                'talent_image' => 'null',
                'talent_description' => 'null',
                'event_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'SoegiBoernean',
                'talent_image' => 'null',
                'talent_description' => 'null',
                'event_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'JepangJowo',
                'talent_image' => 'null',
                'talent_description' => 'null',
                'event_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Pertelon Koplo',
                'talent_image' => 'null',
                'talent_description' => 'null',
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
