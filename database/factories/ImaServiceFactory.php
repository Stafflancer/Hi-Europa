<?php

namespace Database\Factories;

use App\Models\ImaBillingAddress;
use App\Models\Contract;
use App\Models\ImaInterventionAddress;
use App\Models\Quotation;
use App\Models\ImaService;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ImaServiceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ImaService::class;

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
            'ima_billing_address_id' => function () {
                return ImaBillingAddress::factory()->create()->id;
            },
            'ima_intervention_address_id' => function () {
                return ImaInterventionAddress::factory()->create()->id;
            },
            'contract_id' => function () {
                return Contract::factory()->create()->id;
            },
            'quotation_id' => function () {
                return Quotation::factory()->create()->id;
            },
        ];
    }
}
