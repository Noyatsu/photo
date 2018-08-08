<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('photos', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('category_id');
            $table->string('title');
            $table->string('path');
            $table->string('location', 255)->nullable();
            $table->string('location_name', 255)->nullable();
            $table->string('location_address', 255)->nullable();
            $table->string('location_point')->nullable();
            $table->string('tags')->nullable();
            $table->unsignedInteger('views')->default(0);
            $table->unsignedInteger('likes')->default(0);
            $table->text('description')->nullable();
            $table->double('points')->default(0);
            $table->string('filming_date')->nullable();
            $table->string('camera')->nullable();
            $table->string('lens')->nullable();
            $table->string('focal_length')->nullable();
            $table->string('speed')->nullable();
            $table->string('iris')->nullable();
            $table->string('iso')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('category_id')->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('photos');
    }
}
