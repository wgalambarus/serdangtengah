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
            'requirements'    => $this->faker->paragraph,
            'responsibilities'=> $this->faker->paragraph,
            'location'        => $this->faker->city,
            'status'          => 'OPEN',
        ];
    }
}
