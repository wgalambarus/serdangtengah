<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\JobPosition;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\JobPosition>
 */
class JobPositionFactory extends Factory
{
    protected $model = JobPosition::class;

    public function definition()
    {
        return [
            'title'           => $this->faker->jobTitle,
            'description'     => $this->faker->paragraph,
            'location'        => $this->faker->city,
            'salary'          => $this->faker->numberBetween(3000000, 15000000),
            'start_date'      => $this->faker->date(),
            'end_date'        => $this->faker->date(),
            'is_active'       => 1,

        ];
    }
}
