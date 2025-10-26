<?php

namespace Database\Seeders;

use App\Models\Pelamar;
use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PelamarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID'); // ✅ buat instance faker untuk Indonesia

        foreach (range(1, 20) as $index) {
            Pelamar::create([
                'nama_lengkap'   => $faker->name,
                'tempat_lahir'   => $faker->city,
                'tanggal_lahir'  => $faker->date('Y-m-d', '2003-01-01'),
                'jenis_kelamin'  => $faker->randomElement(['Laki-laki', 'Perempuan']),
                'alamat'         => $faker->address,
                'nomor_hp'       => $faker->phoneNumber,
                'cv'             => 'cv_dummy_' . $index . '.pdf',
                'pas_foto'       => 'pasfoto_dummy_' . $index . '.pdf',
                'transkrip_nilai'=> 'transkrip_dummy_' . $index . '.pdf',
                'created_at'     => now(),
                'updated_at'     => now(),
            ]);
        }
    }
}
