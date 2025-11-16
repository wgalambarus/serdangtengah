<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Employee;
use App\Models\User;

use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $faker = Faker::create();

        Employee::factory(20000)->create()->each(function($emp) use ($faker){
            $emp->addresses()->create([
                'type'         => 'CURRENT',
                'address_line' => $faker->streetAddress(),
                'city'         => $faker->city()
            ]);

            $emp->jobHistory()->create([
                'status'      => 'Karyawan',
                'start_date'  => $faker->date(),
                'unit'        => 'Unit '.$faker->randomNumber(2)
            ]);
        });
        User::create([
            'name' => 'Admin Medan',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin123'),
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
