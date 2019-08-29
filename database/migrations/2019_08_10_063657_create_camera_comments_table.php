<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCameraCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('camera_comments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('comment');
            $table->integer('user_id');
            $table->integer('camera_post_id');
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
        Schema::dropIfExists('camera_comments');
    }
}
