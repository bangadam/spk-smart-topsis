<?php

namespace Database\Factories;

use App\Models\Surveyor;
use Illuminate\Database\Eloquent\Factories\Factory;

class SurveyorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Surveyor::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->word,
        'card_id_number' => $this->faker->word,
        'name' => $this->faker->word,
        'photo' => $this->faker->text,
        'birth_place' => $this->faker->word,
        'birth_date' => $this->faker->word,
        'address' => $this->faker->text,
        'village_id' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
