<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class LiveFeedItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('live_feed_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('live_feed_id')->unsigned();
            $table->integer('primary_image')->unsigned();
            $table->integer('secondary_image')->unsigned();
            $table->string('title');
            $table->integer('created_by')->unsigned();
            $table->integer('sort');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('live_feed_id')->references('id')->on('live_feed');
            $table->foreign('primary_image')->references('id')->on('images');
            $table->foreign('secondary_image')->references('id')->on('images');
            $table->foreign('created_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('live_feed_items');
    }
}
