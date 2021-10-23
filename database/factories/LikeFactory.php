<?php

namespace Database\Factories;

use App\Models\Collection;
use App\Models\Item;
use App\Models\Like;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class LikeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Like::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $likeables = [
            Collection::class,
            Item::class,
        ];
        $likeableType = $this->faker->randomElement($likeables);
        $likeableId = $likeableType::factory()->create()->id;

        return [
            'user_id' => User::inRandomOrder()->first()->id,
            'likeable_type' => $likeableType, // App\Models\Collection or App\Models\Item
            'likeable_id' => $likeableId, // collection_id or item_id
        ];
    }
}
