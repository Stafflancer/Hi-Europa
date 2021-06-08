<?php

namespace Database\Factories;

use App\Models\ImaQuotation;
use Illuminate\Database\Eloquent\Factories\Factory;

class ImaQuotationFactory extends Factory
{


    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ImaQuotation::class;


    protected $problem_type = [
        'heater',
        'electricity',
        'plumbing',
        'doors_windows',
        'locksmith',
    ];
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [

            'address' => $this->faker->address,
            'problem_type' => $this->problem_type[$this->faker->numberBetween(0, 4)],
            'precision_one' => $this->faker->text(10),
            'precision_two' => $this->faker->text(10),
            'precision_tree'=> $this->faker->text(10),
            'intervention_date' => $this->faker->dateTime,
            'start_time' => $this->faker->dateTime,
            'cost' => $this->faker->numberBetween(0, 500),
            'ima_user_id' => $this->faker->numberBetween(10, 20),
        ];
    }
}
