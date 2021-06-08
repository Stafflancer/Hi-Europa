<?php

namespace Database\Factories;

use App\Models\Intervention;
use Illuminate\Database\Eloquent\Factories\Factory;

class InterventionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Intervention::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'city' => $this->faker->city,
            'address' => $this->faker->address,
            'comp_address' => $this->faker->address,
            'attendance_person' => $this->faker->numberBetween(0, 1),
            'other_person_first_name' => $this->faker->firstName,
            'other_person_last_name' => $this->faker->lastName,
            'other_person_phone' => $this->faker->phoneNumber,
            'ima_user_id' => $this->faker->numberBetween(1,5),
        ];
    }
}
