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
                'event_name' => 'Festival Arak-Arakan Cheng Ho 2024',
                'event_description' => 'nunggu persetujuan EO',
                'users_id' => 2,
                'price' => 25000,
                'event_location' => 'Sam Poo Kong, Semarang, Jawa Tengah',
                'event_picture' => 'dummy.jpg',
                'event_date' => '2024-08-02',
                'event_start' => '2024-08-02',
                'event_ended' => '2024-08-03',
                'event_status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'event_name' => 'Hitech',
                'event_description' => 'PAMERAN BUOS GANDOS',
                'price' => 100000,
                'event_location' => 'Hotel',
                'event_picture' => 'carousels1.svg',
                'event_date' => '2024-07-01',
                'event_start' => '2024-07-01',
                'event_ended' => '2024-07-01',
                'event_status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
