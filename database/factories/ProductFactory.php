<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $productNames = [
            'Televisão',
            'Video Game',
            'Computador',
            'Caixa de Som',
            'Notebook',
            'Monitor',
            'Cadeira',
            'Mesa',
            'Webcam',
            'Roteador',
        ];

        $name = $this->faker->unique()->randomElement($productNames);

        return [
            'name' => $name,
            'price' => $this->faker->randomFloat(2, 10, 100),
            'photo' => $this->faker->imageUrl(),
            'active' => $this->faker->boolean(),
        ];
    }
}
