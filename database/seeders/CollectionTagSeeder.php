<?php

namespace Database\Seeders;

use App\Models\Collection;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class CollectionTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = Tag::all();

        // Populate the pivot table by attaching up to 5 random tags for each collection.
        Collection::all()->each(function ($collection) use ($tags) { 
            $collection->tags()->attach(
                $tags->random(rand(1, 5))->pluck('id')
            ); 
        });
    }
}
