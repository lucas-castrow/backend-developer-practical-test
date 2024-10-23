<?php

namespace Database\Factories;

use App\Models\RpcProvider;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RpcProvider>
 */
class RpcProviderFactory extends Factory
{
    protected $model = RpcProvider::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'url' => fake()->name(),
            'name' => fake()->name(),
            'chain_id' => fake()->name(),
        ];
    }
}
