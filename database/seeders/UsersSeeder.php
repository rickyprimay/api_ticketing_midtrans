<?php

namespace Database\Seeders;

use App\Models\Users;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Users::factory()->create([
            'name' => 'Ricky Primayuda Putra',
            'birth_date' => '2004-05-22',
            'email' => 'rickyprima30@gmail.com',
            'password' => Hash::make('rickyprima30@gmail.com'),
            'gender' => 'Male',
            'phone_number' => '123456789',
            'is_verified' => true,
            'role' => 0,
        ]);

        Users::factory()->create([
            'name' => 'Committee User',
            'birth_date' => '1990-01-01',
            'email' => 'panitia@gmail.com',
            'password' => Hash::make('panitia@gmail.com'),
            'gender' => 'Female',
            'phone_number' => '987654321',
            'is_verified' => true,
            'role' => 1,
        ]);

        Users::factory()->create([
            'name' => 'Cipta Kharisma',
            'birth_date' => '1985-01-01',
            'email' => 'ticketifyid@gmail.com',
            'password' => Hash::make('ticketifyid@gmail.com'),
            'gender' => 'Male',
            'phone_number' => '1122334455',
            'is_verified' => true,
            'role' => 2,
        ]);
        Users::factory()->create([
            'name' => 'Superadmin',
            'birth_date' => '1985-01-01',
            'email' => 'noreply@ticketify.id',
            'password' => Hash::make('noreply@ticketify.id'),
            'gender' => 'Male',
            'phone_number' => '1122334455',
            'is_verified' => true,
            'role' => 3,
        ]);
    }
}
