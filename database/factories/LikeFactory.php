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
        // Selects either Collection or Item.
        $likeableType = $this->faker->randomElement($likeables);
        
        $likeableId = '';
        if ($likeableType === Collection::class) {
            $likeableId = Collection::inRandomOrder()->first()->id;
        } else {
            $likeableId = Item::inRandomOrder()->first()->id;
        }

        return [
            'user_id' => User::inRandomOrder()->first()->id,
            'likeable_type' => $likeableType, // Either App\Models\Collection or App\Models\Item
            'likeable_id' => $likeableId, // Either 'collection_id' or 'item_id'
        ];
    }
}
