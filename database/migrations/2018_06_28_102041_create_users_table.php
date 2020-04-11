<?php

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
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('phone')->unique()->nullable();
            $table->string('profile')->nullable();
            $table->string('username')->unique();
            $table->string('password');
            $table->string('display_name')->nullable();
            $table->tinyInteger('status');
            $table->tinyInteger('online');
            $table->string('last_logged');
            $table->rememberToken();
            $table->timestamps();

            $table->integer('role_id')->unsigned();
            $table->foreign('role_id')->references('id')
            ->on('roles')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
