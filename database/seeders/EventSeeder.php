<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
                'event_description' => 'Festival arak-arakan Cheng Ho 2024 merupakan arak-arakan Budaya dari Klenteng Tay Kak Sie di Gang Lombok Pecinan menuju ke Sam Poo Kong yang diikuti oleh ribuan orang dari berbagai kota. Hari kedatangan Sam Poo Tay Djien (Laksamana Cheng Ho) ini diperingati setahun sekali dengan kirab membawa Patung Dewa. Festival Laksamana Cheng Ho ini dimeriahkan pula dengan panggung kesenian yang menampilkan perpaduan seni budaya Tionghoa dan Jawa serta berbagai hiburan musik sebagai perayaan bersama masyakarat.',
                'users_id' => 3,
                'price' => 25000,
                'event_location' => 'Sam Poo Kong, Semarang, Jawa Tengah',
                'event_picture' => 'event_pictures/juioakdowakod09012.jpg',
                'event_date' => '2024-08-02',
                'event_start' => '2024-08-02',
                'event_ended' => '2024-08-04',
                'event_status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
        ]);
    }
}
