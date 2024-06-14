<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create([
            'id' => 1,
            'name' => 'Direktur',
            'label' => 'direktur'
        ]);
        Role::create([
            'id' => 2,
            'name' => 'Manager Operasional',
            'label' => 'manager-operasional'
        ]);
        Role::create([
            'id' => 3,
            'name' => 'Manager Keuangan',
            'label' => 'manager-keuangan'
        ]);
        Role::create([
            'id' => 4,
            'name' => 'Staf Operasional',
            'label' => 'staf-operasional'
        ]);
        Role::create([
            'id' => 5,
            'name' => 'Staf Keuangan',
            'label' => 'staf-keuangan'
        ]);
    }
}