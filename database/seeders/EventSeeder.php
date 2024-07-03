<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('events')->insert([
            [
                'event_name' => 'Semnasti',
                'event_description' => 'JOS GANDOS',
                'price' => 40000,
                'event_location' => 'Semarang',
                'event_picture' => 'picture_one.jpg',
                'event_date' => '2024-07-01',
                'event_status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'event_name' => 'Hitech',
                'event_description' => 'PAMERAN BUOS GANDOS',
                'price' => 70000,
                'event_location' => 'Hotel',
                'event_picture' => 'picture_one.jpg',
                'event_date' => '2024-07-01',
                'event_status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
