<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(UserTableSeeder::class);
        $this->call(TagTableSeeder::class);
        $this->call(ItemTableSeeder::class);
        $this->call(CollectionTableSeeder::class);
        $this->call(CommentTableSeeder::class);
        $this->call(LikeTableSeeder::class);
        $this->call(FollowTableSeeder::class);
    }
}
