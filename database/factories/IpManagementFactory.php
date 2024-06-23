<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\IpManagement>
 */
class IpManagementFactory extends Factory
{
    protected $model = \App\Models\IpManagement::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'ip_address' => $this->faker->ipv4,
            'label' => $this->faker->word,
            'comment' => $this->faker->sentence,
        ];
    }
}
