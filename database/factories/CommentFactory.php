<?php

namespace Database\Factories;

use App\Models\Collection;
use App\Models\Comment;
use App\Models\Item;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Comment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $commentables = [
            'App\Collection',
            'App\Item',
        ];
        $commentableType = $this->faker->randomElement($commentables);

        $commentableId = '';
        if ($commentableType === 'App\Collection') {
            $commentableId = Collection::inRandomOrder()->first()->id;
        } else {
            $commentableId = Item::inRandomOrder()->first()->id;
        }
        

        return [
            'comment' => $this->faker->sentence($nbWords = 8),
            'user_id' => User::inRandomOrder()->first()->id,
            'commentable_type' => $commentableType, // App\Models\Collection or App\Models\Item
            'commentable_id' => $commentableId, // collection_id or item_id
        ];
    }
}
