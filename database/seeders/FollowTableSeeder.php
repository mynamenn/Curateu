<?php

namespace Database\Seeders;

use App\Models\Follow;
use Illuminate\Database\Seeder;

class FollowTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $follows = Follow::factory()->count(10)->create();
    }
}
