<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('tickets')->insert([
            [
                'events_id' => 1,
                'ticket_type' => 'Day 1',
                'price' => 35000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'events_id' => 1,
                'ticket_type' => 'Day 2',
                'price' => 35000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'events_id' => 1,
                'ticket_type' => 'Day 3',
                'price' => 25000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'events_id' => 1,
                'ticket_type' => 'Bundling Day 1 & 2',
                'price' => 65000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'events_id' => 2,
                'ticket_type' => 'VIP',
                'price' => 150000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'events_id' => 2,
                'ticket_type' => 'Regular',
                'price' => 100000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
