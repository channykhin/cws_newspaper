<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('slug')->nullable();
            $table->text('img');
            $table->text('img_slider');
            $table->text('short_desc');
            $table->text('body');
            $table->tinyInteger('status');
            $table->integer('views')->default(0);
            $table->string('author')->nullable();
            $table->string('reference')->nullable();
            $table->string('reference_link')->nullable();
            $table->timestamps();

            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')
            ->on('users')
            ->onDelete('cascade');
            $table->integer('categories_id')->unsigned()->nullable();
            $table->foreign('categories_id')->references('id')
            ->on('categories')
            ->onDelete('cascade');
            $table->integer('sub_categories_id')->unsigned()->nullable();
            $table->foreign('sub_categories_id')->references('id')
            ->on('sub_categories')
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
        Schema::drop('articles');
    }
}
