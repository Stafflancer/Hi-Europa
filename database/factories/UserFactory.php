<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'first_name'      => $this->faker->firstName,
            'last_name'       => $this->faker->lastName,
            'title'           => $this->faker->randomElement(['Monsieur', 'Madame']),
            'gender'           => $this->faker->randomElement(['male', 'female']),
            'phone_number'    => $this->faker->phoneNumber,
            'landline_phone'  => $this->faker->phoneNumber,
            'email'           => $this->faker->safeEmail,
            'postal_code'     => $this->faker->numberBetween(1, 99999),
            'birthday'        => $this->faker->date(),
            'address'         => $this->faker->address,
            'city'            => $this->faker->city,
            'opt_in_hieuropa' => $this->faker->numberBetween(0, 1),
            'residency_type'  => 'Appartement',
            'residence_type'  => 'Principale',
            'floor'           => $this->faker->randomElement(['Rez_de_chaussee', 'Intermediaire', 'Dernier_etage']),
            'number_rooms'    => $this->faker->numberBetween(10, 100),
            'got_insurance'   => $this->faker->numberBetween(0, 1),
            'live_there_time' => $this->faker->date(),
            'insured_time'    => $this->faker->date(),
            'is_pb_prime'     => $this->faker->numberBetween(0, 1),
            //'contract_id'     => $this->faker->numberBetween(1, 50),
        ];
    }
}
