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
            'name' => $this->faker->text(30),
        ];
    }
}
