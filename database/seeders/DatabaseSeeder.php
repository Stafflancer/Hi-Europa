<?php

namespace Database\Seeders;

use App\Models\Contract;
use App\Models\ImaQuotation;
use App\Models\ImaService;
use App\Models\ImaUser;
use App\Models\Intervention;
use App\Models\Prospect;
use App\Models\Quotation;
use App\Models\Resident;
use App\Models\Resiliation;
use App\Models\User;
use App\Models\WakamService;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
//        WakamService::factory()->count(50)->create();
//        ImaService::factory()->count(50)->create();
//        User::factory()->count(50)->create();
//        Contract::factory()->count(50)->create();
//        Quotation::factory()->count(50)->create();
//        Resiliation::factory()->count(50)->create();
//        ImaUser::factory()->count(50)->create();
//        Intervention::factory()->count(50)->create();
//        ImaQuotation::factory()->count(50)->create();
//        Resident::factory()->count(50)->create();
//        Prospect::factory()->count(50)->create();

        $this->call([
            AdminRoleSeeder::class,
            AdminSeeder::class,
        ]);
    }
}
