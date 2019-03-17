<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeedTablesSet extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('company_id')->unsigned();
            $table->string('name');
            $table->string('original_name');
            $table->boolean('is_primary')->unsigned();
            $table->integer('created_by')->unsigned();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('company_id')->references('id')->on('companies');
            $table->foreign('created_by')->references('id')->on('users');
        });

        Schema::create('feed', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('company_id')->unsigned();
            $table->string('name');
            $table->integer('created_by')->unsigned();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('company_id')->references('id')->on('companies');
            $table->foreign('created_by')->references('id')->on('users');
        });

        Schema::create('feed_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('feed_id')->unsigned();
            $table->integer('primary_image')->unsigned();
            $table->integer('secondary_image')->unsigned();
            $table->string('title');
            $table->integer('created_by')->unsigned();
            $table->integer('sort');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('feed_id')->references('id')->on('feed');
            $table->foreign('primary_image')->references('id')->on('images');
            $table->foreign('secondary_image')->references('id')->on('images');
            $table->foreign('created_by')->references('id')->on('users');
        });

        Schema::create('live_feed', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('feed_id')->unsigned();
            $table->string('company_id');
            $table->boolean('is_published');
            $table->integer('published_by')->unsigned();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('feed_id')->references('id')->on('feed');
            $table->foreign('published_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('live_feed');
        Schema::dropIfExists('feed_items');
        Schema::dropIfExists('feed');
        Schema::dropIfExists('images');
    }
}
