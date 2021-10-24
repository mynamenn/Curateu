<?php

namespace Database\Seeders;

use App\Models\Collection;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class CollectionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Collection::factory(10)->hasItems(1)->create();
    }
}
