<?php

namespace Database\Factories;

use App\Models\ImaInterventionAddress;
use Illuminate\Database\Eloquent\Factories\Factory;

class ImaInterventionAddressFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ImaInterventionAddress::class;

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
