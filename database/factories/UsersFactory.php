<?php

namespace Database\Factories;

use App\Models\Users;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class UsersFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Users::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'birth_date' => $this->faker->date,
            'email' => $this->faker->unique()->safeEmail,
            'password' => Hash::make('password'), // or bcrypt('password')
            'gender' => $this->faker->randomElement(['Male', 'Female']),
            'phone_number' => $this->faker->phoneNumber,
            'role' => $this->faker->randomElement([0, 1, 2]),
        ];
    }
}
