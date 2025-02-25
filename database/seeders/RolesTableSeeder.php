<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;


class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Добавляем базовые роли
        Role::create([
            'name' => 'admin',
        ]);

        Role::create([
            'name' => 'moderator',
        ]);

        Role::create([
            'name' => 'user',
        ]);
    }
}
