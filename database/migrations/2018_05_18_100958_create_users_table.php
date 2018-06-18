<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('screen_name')->unique();
            $table->string('name');
            $table->string('location')->nullable();
            $table->string('description')->nullable();
            $table->string('url')->nullable();
            $table->string('time_zone')->nullable();
            $table->string('lang')->nullable();
            $table->string('verified')->nullable();
            $table->string('icon')->nullable();
            $table->string('background')->nullable();
            $table->string('api_token', 60)->unique()->nullable();
            $table->string('remember_token')->nullable();
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
        Schema::dropIfExists('users');
    }
}
