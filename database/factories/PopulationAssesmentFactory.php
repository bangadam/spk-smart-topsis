<?php

namespace Database\Factories;

use App\Models\PopulationAssesment;
use Illuminate\Database\Eloquent\Factories\Factory;

class PopulationAssesmentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PopulationAssesment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'sub_criteria_id' => $this->faker->randomDigitNotNull,
        'population_id' => $this->faker->randomDigitNotNull,
        'value' => $this->faker->randomDigitNotNull,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
