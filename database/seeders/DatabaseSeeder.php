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

        Employee::factory(100)->create()->each(function($emp) use ($faker){
            $emp->addresses()->create([
                'type'         => 'CURRENT',
                'address_line' => $faker->streetAddress(),
                'city'         => $faker->city(),
                'district'     => $faker->citySuffix(),
                'village'      => $faker->streetName(),
                'province'     => $faker->state(),
                'postal_code'  => $faker->postcode(),
            ]);

            $emp->addresses()->create([
                'type'         => 'KTP',
                'address_line' => $faker->streetAddress(),
                'city'         => $faker->city(),
                'district'     => $faker->citySuffix(),
                'village'      => $faker->streetName(),
                'province'     => $faker->state(),
                'postal_code'  => $faker->postcode(),
            ]);

            $emp->jobHistory()->create([
                'status'      => 'Karyawan',
                'start_date'  => $faker->date(),
                'unit'        => 'Unit '.$faker->randomNumber(2)
            ]);

            $emp->trainings()->create([
                'title'       => 'Training '.$faker->word(),
                'year'        => $faker->year(),
                'location'    => $faker->city(),
                'provider'    => $faker->company(),
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
