<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Muhammad Ziqqi Pramudia',
            'username' => 'ziqqi',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('pass'),
        ]);
    }
}
