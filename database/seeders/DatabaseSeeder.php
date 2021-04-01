<?php

namespace Database\Seeders;

use App\Models\Contract;
use App\Models\ImaService;
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
        WakamService::factory()->count(50)->create();
        ImaService::factory()->count(50)->create();

        $this->call([
            AdminSeeder::class,
        ]);
    }
}
