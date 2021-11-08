<?php

namespace Database\Factories;

use App\Models\Collection;
use App\Models\Item;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CollectionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Collection::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'description' => $this->faker->sentence($nbWords = 8),
            'user_id' => User::inRandomOrder()->first()->id,
            'photo' => $this->faker->imageUrl($width = 500, $height = 500),
        ];
    }
}
