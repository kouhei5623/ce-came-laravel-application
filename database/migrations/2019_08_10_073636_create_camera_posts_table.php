<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCameraPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('camera_posts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('camera_name');
            $table->integer('star');
            $table->string('url');
            $table->string('review');
            $table->string('picture');
            $table->integer('user_id');
            $table->string('user_name');
            $table->string('user_picture');
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
        Schema::dropIfExists('camera_posts');
    }
}
