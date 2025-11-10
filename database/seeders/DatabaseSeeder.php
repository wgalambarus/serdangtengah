<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Contoh membuat user manual
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Jalankan seeder lainnya
        $this->call([
            PelamarSeeder::class,
            // Tambahkan seeder lain di sini (misalnya PelamarSeeder, StatistikSeeder, dst)
        ]);
    }
}
