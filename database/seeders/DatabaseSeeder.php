<?php

namespace Database\Seeders;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Memanggil seeder lain agar dijalankan secara berurutan
        $this->call([
            UserSeeder::class,        // Seeder untuk Admin The Bilabola Space
            SuperAdminSeeder::class,   // Seeder untuk Super Admin
            CategorySeeder::class,    // Seeder untuk Menu/Kategori
        ]);
    }
}