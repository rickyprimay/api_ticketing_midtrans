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
            'users_id' => (string) Str::uuid(),
            'name' => 'Ricky Primayuda Putra',
            'birth_date' => '2004-05-22',
            'email' => 'rickyprima30@gmail.com',
            'password' => Hash::make('rickyprima30@gmail.com'),
            'gender' => 'Male',
            'phone_number' => '123456789',
            'role' => 0,
        ]);

        // User with role 1 (committee)
        Users::factory()->create([
            'users_id' => (string) Str::uuid(),
            'name' => 'Committee User',
            'birth_date' => '1990-01-01',
            'email' => 'committee@example.com',
            'password' => Hash::make('committee@example.com'),
            'gender' => 'Female',
            'phone_number' => '987654321',
            'role' => 1,
        ]);

        // User with role 2 (admin)
        Users::factory()->create([
            'users_id' => (string) Str::uuid(),
            'name' => 'Admin User',
            'birth_date' => '1985-01-01',
            'email' => 'admin@example.com',
            'password' => Hash::make('admin@example.com'),
            'gender' => 'Male',
            'phone_number' => '1122334455',
            'role' => 2,
        ]);
    }
}
