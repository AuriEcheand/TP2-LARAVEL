<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Etudiant>
 */
class EtudiantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nom' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'date_naissance' => $this->faker->date(),
            'phone' => $this->faker->phoneNumber(),
            'adresse' => $this->faker->address(),
            'ville_id' => $this->faker->numberBetween(1, 15),
            'user_id' => $this->faker->numberBetween(1, 100),
        ];
    }
}
