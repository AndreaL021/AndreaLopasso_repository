<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddGoogleVisionFieldsToAnnouncementImages extends Migration
{
    
    public function up()
    {
        Schema::table('announcement_images', function (Blueprint $table) {
            $table->text('labels')->nullable();
            $table->string('adult')->nullable();
            $table->string('spoof')->nullable();
            $table->string('medical')->nullable();
            $table->string('violence')->nullable();
            $table->string('racy')->nullable();
        });
    }

    public function down()
    {
        Schema::table('announcement_images', function (Blueprint $table) {
            $table->dropColumn(['labels', 'adult', 'spoof', 'medical', 'violence', 'racy']);
        });
    }
}
