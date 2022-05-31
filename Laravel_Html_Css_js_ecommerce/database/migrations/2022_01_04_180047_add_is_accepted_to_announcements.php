<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsAcceptedToAnnouncements extends Migration
{
    public function up()
    {
        Schema::table('announcements', function (Blueprint $table) {
            $table->boolean('is_accepted')->nullable();
        });
    }

    public function down()
    {
        Schema::table('announcements', function (Blueprint $table) {
            $table->dropColumn('is_accepted');
        });
    }
}
