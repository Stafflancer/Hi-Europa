<?php

namespace Database\Factories;

use App\Models\Contract;
use App\Models\Quotation;
use App\Models\Resiliation;
use App\Models\User;
use App\Models\WakamInsurance;
use App\Models\WakamService;
use Illuminate\Database\Eloquent\Factories\Factory;

class WakamServiceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = WakamService::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => function () {
                return User::factory()->create()->id;
            },
            'quotation_id'  => function () {
                return Quotation::factory()->create()->id;
            },
            'wakam_insurance_id' => function () {
                return WakamInsurance::factory()->create()->id;
            },
            'contract_id' => function () {
                return Contract::factory()->create()->id;
            },
            'resiliation_id' => function () {
                return Resiliation::factory()->create()->id;
            },
        ];
    }
}
