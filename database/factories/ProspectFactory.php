<?php

namespace Database\Factories;

use App\Models\Prospect;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProspectFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Prospect::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'residency_type' => 'Appartement',
            'prospect_type' => 'Proprietaire',
            'residence_type' => 'Principale',
            'floor' => $this->faker->randomElement(['Rez_de_chaussee', 'Intermediaire', 'Dernier_etage']),
            'surface' => $this->faker->numberBetween(10, 100),
            'number_rooms' => $this->faker->numberBetween(10, 100),
            'got_insurance' => $this->faker->numberBetween(0, 1),
            'live_there_time' => $this->faker->date(),
            'insured_time' => $this->faker->date(),
            'postal_code' => $this->faker->numberBetween(1, 99999),
            'email' => $this->faker->safeEmail,
            'opt_in_hieuropa' => $this->faker->numberBetween(0, 1),
        ];
    }
}
