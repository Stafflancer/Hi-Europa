<?php

namespace Database\Factories;

use App\Models\ImaBillingAddress;
use Illuminate\Database\Eloquent\Factories\Factory;

class ImaBillingAddressFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ImaBillingAddress::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'address' => $this->faker->address,
        ];
    }
}
