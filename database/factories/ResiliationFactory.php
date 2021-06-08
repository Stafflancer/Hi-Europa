<?php

namespace Database\Factories;

use App\Models\Resiliation;
use Illuminate\Database\Eloquent\Factories\Factory;

class ResiliationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Resiliation::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'insurance_company_name' => $this->faker->company,
            'previous_contract' => $this->faker->numberBetween(10000, 90000),
            'subscription_date' => $this->faker->date(),
            //'user_id'           => $this->faker->numberBetween(1,5),
            'moving_out'        => $this->faker->numberBetween(0,1),
            //'contract_id'       => $this->faker->numberBetween(1, 50),
            'insured_firstname' => $this->faker->firstName(),
            'insured_surname'   => $this->faker->lastName(),
        ];
    }
}
