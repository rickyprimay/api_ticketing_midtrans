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
                'ticket_type' => 'Umum',
                'price' => 100000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'events_id' => 1,
                'ticket_type' => 'Pelajar',
                'price' => 500000,
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
