<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Admin::insert([
        [
          'name' => 'Christopher Hieuropa',
          'admin_role_id' => 3,
          'email' => 'christopher.akinboboye@it-consultis.com',
          'password' => Hash::make('9O6y%)I7)Ri7I4IxcxDE0)LC'),
          'created_at' => now()
        ],
        [
          'name' => 'Hieuropa',
          'admin_role_id' => 1,
          'email' => 'matthieu.lejay@it-consultis.com',
          'password' => Hash::make('9O6y%)I7)Ri7I4IxcxDE0)LC'),
          'created_at' => now()
        ],
      ]);
    }
}
