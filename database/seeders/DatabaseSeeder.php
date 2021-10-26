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
        $this->call(CollectionTableSeeder::class);
        $this->call(ItemTableSeeder::class);
        $this->call(TagTableSeeder::class);
        $this->call(CollectionTagSeeder::class);
        $this->call(CommentTableSeeder::class);
        $this->call(LikeTableSeeder::class);
        $this->call(FollowerTableSeeder::class);
    }
}
