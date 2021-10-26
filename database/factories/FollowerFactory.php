<?php

namespace Database\Factories;

use App\Models\Follower;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Schema;

class FollowerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Follower::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $userId = User::inRandomOrder()->first()->id;
        $followingId = User::inRandomOrder()->first()->id;

        // Keep updating followingId if it's the same as userId or (userId, followingId) 
        // already exists in Follower table.
        while ($followingId === $userId || 
        Follower::where([['user_id', '=', $userId], ['following_id', '=', $followingId]])->exists()) {
            $followingId = User::inRandomOrder()->first()->id;
        }

        return [
            'user_id' => $userId,
            'following_id' => $followingId,
        ];
        
    }
}
