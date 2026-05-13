<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Abdul Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('nurwan'), // Ganti dengan password pilihanmu
            'role' => 'admin', // Atau 'owner' sesuai kebutuhan
        ]);
    }
}