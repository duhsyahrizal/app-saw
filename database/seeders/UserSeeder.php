<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'      => 'Admin',
            'username'  => 'admin',
            'email'     => 'admin@company.com',
            'password'  => bcrypt('admin123'),
        ]);
    }
}
