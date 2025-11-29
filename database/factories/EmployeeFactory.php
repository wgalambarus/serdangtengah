<?php

namespace Database\Factories;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
protected $model = Employee::class;

    public function definition()
    {
        return [
            'employee_no'   => 'EMP' . $this->faker->unique()->numerify('#####'),
            'full_name'     => $this->faker->name,
            'birth_place'   => $this->faker->city,
            'birth_date'    => $this->faker->date(),
            'gender'        => $this->faker->randomElement(['L','P']),
            'last_education'=> $this->faker->randomElement(['SMA','D3','S1','S2']),
            'marital_status'=> $this->faker->randomElement(['MENIKAH','DUDA','JANDA','BELUM_MENIKAH']),
            'religion'      => $this->faker->randomElement(['Islam','Kristen','Hindu','Budha']),
            'blood_type'    => $this->faker->randomElement(['A','B','AB','O']),
            'national_id'   => $this->faker->unique()->numerify('################'),
            'npwp'          => $this->faker->unique()->numerify('##.###.###.#-###.###'),
            'bpjs_tk'     => $this->faker->unique()->numerify('###########'),
            'bpjs_kes'    => $this->faker->unique()->numerify('###########'),
            'emergency_name'  => $this->faker->name,
            'emergency_relation' => $this->faker->randomElement(['Orang Tua','Saudara','Pasangan','Teman']),
            'emergency_phone'    => $this->faker->phoneNumber,
            'phone'         => $this->faker->phoneNumber,
            'skills'        => json_encode($this->faker->randomElements(['php','laravel','mysql','docker','aws'], 2)),
        ];
    }
}
