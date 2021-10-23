<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLikesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('likes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->morphs('likeable'); // Adds unsighned integer likeable_id and string likeable_type (Collection, Item).
            $table->softDeletes(); // To know when user unlike a post so won't send notifications.
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('likes', function (Blueprint $table) {  
            $table->dropForeign(['user_id']);
            $table->dropMorphs('likeable');	
        });

        Schema::dropIfExists('likes');
    }
}
