<?php

namespace Database\Factories;

use App\Models\ImaUser;
use Illuminate\Database\Eloquent\Factories\Factory;

class ImaUserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ImaUser::class;

    protected $prospect_type = ['owner', 'tenant'];


    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'first_name'    => $this->faker->firstName,
            'last_name'     => $this->faker->lastName,
            'phone_number'  => $this->faker->phoneNumber,
            'email'         => $this->faker->safeEmail,
            'title'         => $this->faker->title,
            'postal_code'         => $this->faker->postcode,
            'account_id'         => $this->faker->numberBetween(100000, 900000),
            'prospect_type' => $this->prospect_type[$this->faker->numberBetween(0, 1)],
        ];
    }
}
