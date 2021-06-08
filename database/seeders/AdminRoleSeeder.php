<?php

namespace Database\Seeders;

use App\Models\AdminRole;
use Illuminate\Database\Seeder;

class AdminRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AdminRole::insert([
            [
                'name' => 'admin'
            ],
            [
                'name' => 'editor'
            ],
            [
                'name' => 'developer'
            ],
        ]);
    }
}
