<?php

namespace Database\Factories;

use App\Models\Quotation;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class QuotationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Quotation::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'postal_code' => $this->faker->numberBetween(1, 99999),
            'type_accommodation' => 'Appartement',
            'prospect_type' => 'Proprietaire',
            'type_residence' => 'Principale',
            'apartment_floor' => $this->faker->randomElement(['Rez_de_chaussee', 'Intermediaire', 'Dernier_etage']),
            'apartment_surface' => '20',
            'room' => $this->faker->numberBetween(1,5),
            'insured' => $this->faker->numberBetween(0, 1),
            'termination' => $this->faker->numberBetween(0, 1),
            'franchise' => $this->faker->numberBetween(10, 1000),
            'furniture_capital' => $this->faker->numberBetween(10, 1000),
            'furniture_two_years_old' => $this->faker->numberBetween(0, 1),
            'option_glass' => $this->faker->numberBetween(0, 1),
            'option_thief' => $this->faker->numberBetween(0, 1),
            'option_mobile' => $this->faker->numberBetween(0, 1),
            'school_insurance' => $this->faker->numberBetween(0, 1),
            'dependencies' => $this->faker->numberBetween(0, 1),
            'total_value_furniture_400' => $this->faker->numberBetween(400, 1700),
            'total_value_furniture_1800' => $this->faker->numberBetween(1800, 9000),
            'estimated_coverage' => $this->faker->numberBetween(10, 9000),
            'cost_month' => $this->faker->numberBetween(10, 9000),
            //'contract_id' => $this->faker->numberBetween(1,5),
            //'user_id' => $this->faker->numberBetween(1,5),
        ];
    }
}
