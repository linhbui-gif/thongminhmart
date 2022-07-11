<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostRelatedPostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('post_related_post', function (Blueprint $table) {
        //     $table->id();
        //     $table->integer('post_id');
        //     $table->foreign('post_id')->references('id')->on('blog_posts')->onDelete('cascade');
        //     $table->integer('related_post_id');
        //     $table->foreign('related_post_id')->references('id')->on('blog_posts')->onDelete('cascade');
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_related_post');
    }
}
