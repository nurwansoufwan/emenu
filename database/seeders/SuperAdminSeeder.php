<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Update existing admin to role admin
        User::where('email', 'admin@gmail.com')->update(['role' => 'admin']);

        // Create Super Admin
        User::updateOrCreate(
            ['email' => 'superadmin@gmail.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('superadmin123'),
                'role' => 'superadmin'
            ]
        );
    }
}
