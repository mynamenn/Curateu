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
        $this->call(RoleTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(CollectionTableSeeder::class); // Each collection has at least 1 item and tag.
        $this->call(ItemTableSeeder::class);
        $this->call(TagTableSeeder::class);
        $this->call(CollectionTagSeeder::class); // Seeds many to many relationship.
        // $this->call(CommentTableSeeder::class);
        // $this->call(LikeTableSeeder::class);
        // $this->call(FollowTableSeeder::class);
    }
}
