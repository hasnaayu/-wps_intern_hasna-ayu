<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'user_id' => '1234',
            'name' => 'Doni',
            'username' => 'doni',
            'email' => 'doni@gmail.com',
            'password' => Hash::make('123456'),
            'role_id' => 1,
            'is_active' => 1
        ]);
        User::create([
            'user_id' => '1235',
            'name' => 'Angga',
            'username' => 'angga',
            'email' => 'angga@gmail.com',
            'password' => Hash::make('123456'),
            'role_id' => 2,
            'is_active' => 1
        ]);
        User::create([
            'user_id' => '1236',
            'name' => 'Alvaro',
            'username' => 'alvaro',
            'email' => 'alvaro@gmail.com',
            'password' => Hash::make('123456'),
            'role_id' => 3,
            'is_active' => 1
        ]);
        User::create([
            'user_id' => '1237',
            'name' => 'Lia',
            'username' => 'lia',
            'email' => 'lia@gmail.com',
            'password' => Hash::make('123456'),
            'role_id' => 4,
            'is_active' => 1
        ]);
        User::create([
            'user_id' => '1238',
            'name' => 'Saskia',
            'username' => 'saskia',
            'email' => 'saskia@gmail.com',
            'password' => Hash::make('123456'),
            'role_id' => 5,
            'is_active' => 1
        ]);
    }
}
