<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserCheckInTopicsStreakColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_check_in_topics', function ($table) {
            $table->unsignedInteger('streak')->default(0)->after('date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_check_in_topics', function ($table) {
            $table->dropColumn(['streak']);
        });
    }
}
