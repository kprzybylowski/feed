<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class LiveFeedName extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('live_feed', function (Blueprint $table) {
            if (!Schema::hasColumn('live_feed', 'name')) $table->string('name')->after('company_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
		Schema::table('live_feed', function (Blueprint $table) {
			if (Schema::hasColumn('live_feed', 'name')) { $table->dropColumn('name'); }
		});
    }
}
