<?php

namespace Database\Seeders;

use App\Models\Users;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        Users::factory()->create([
            'name' => 'Ricky Primayuda Putra',
            'birth_date' => '2004-05-22',
            'email' => 'rickyprima30@gmail.com',
            'password' => Hash::make('rickyprima30@gmail.com'),
            'gender' => 'Male',
            'phone_number' => '123456789',
            'role' => 0,
        ]);
    }
}
