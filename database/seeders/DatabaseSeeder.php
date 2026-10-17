<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin Laundry',
            'email' => 'admin@laundry.test',
            'password' => 'password',
            'role' => 'admin',
        ]);
    }
}