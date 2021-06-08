<?php

namespace Database\Factories;

use App\Models\Contract;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContractFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Contract::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'exact_address' => $this->faker->address,
            'additional_address' => $this->faker->address,
            'city' => $this->faker->city,
            'postal_code' => $this->faker->numberBetween(1, 99999),
            'transfer_date' => $this->faker->randomElement(['5' ,'10', '15']),
            'contract_start_date' => $this->faker->date(),
            'contract_expiration_date' => $this->faker->date(),
            'dependance_postal_code' => $this->faker->numberBetween(1, 99999),
            'dependance_adresse' => $this->faker->address,
            'dependance_comp_adresse' => $this->faker->address,
            'dependance_city' => $this->faker->city,
            //'user_id' => $this->faker->numberBetween(1, 50),
            'price_per_month' => $this->faker->numberBetween(1, 50),
            //'quotation_id' => $this->faker->numberBetween(1, 50),
            //'resiliation_id' => $this->faker->numberBetween(1, 50),
        ];
    }
}
