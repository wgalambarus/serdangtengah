<?php

namespace Database\Factories;

use App\Models\Applicant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Applicant>
 */
class ApplicantFactory extends Factory
{
    protected $model = Applicant::class;

    public function definition()
    {
        return [
            'full_name'   => $this->faker->name,
            'birth_place' => $this->faker->city,
            'birth_date'  => $this->faker->date(),
            'gender'      => $this->faker->randomElement(['L','P']),
            'address'     => $this->faker->address,
            'phone'       => $this->faker->phoneNumber,
        ];
    }
}
