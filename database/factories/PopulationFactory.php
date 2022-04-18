<?php

namespace Database\Factories;

use App\Models\Population;
use Illuminate\Database\Eloquent\Factories\Factory;

class PopulationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Population::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'card_id_number' => $this->faker->word,
        'family_card_id' => $this->faker->word,
        'name' => $this->faker->word,
        'phone_number' => $this->faker->word,
        'gender' => $this->faker->word,
        'birth_date' => $this->faker->word,
        'address' => $this->faker->text,
        'village_id' => $this->faker->word,
        'zip_code' => $this->faker->word,
        'created_by' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
