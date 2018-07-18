<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMediaTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('media', function (Blueprint $table) {
            $table->increments('id');
            $table->string('size')->nullable();;
            $table->string('type')->nullable();;
            $table->string('filename')->nullable();;
            $table->string('url')->nullable();
            $table->string('video_thumb')->nullable();
            $table->string('media_description')->nullable();
            $table->string('media_title')->nullable();
            $table->integer('download_count')->nullable();
            $table->timestamp('last_download_time')->nullable();
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('media');
    }
}
