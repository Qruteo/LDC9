<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@ldc9.com'],
            [
                'name' => 'admin',
                'password' => 'admin12345',
                'role' => 'admin',
            ]
        );
    }
}