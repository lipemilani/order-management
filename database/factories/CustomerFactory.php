<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    protected $model = Customer::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail,
            'phone' => fake()->phoneNumber,
            'date_of_birth' => fake()->date('Y-m-d'),
            'address' => fake()->address,
            'complement' => fake()->optional()->word,
            'neighborhood' => fake()->word,
            'cep' => fake()->postcode,
            'created_at' => fake()->dateTimeBetween('-1 year', 'now')->format('Y-m-d H:i:s'),
            'active' => fake()->boolean
        ];
    }
}
