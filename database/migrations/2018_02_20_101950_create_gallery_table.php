<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGalleryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('galleries', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('description')->nullable();
            $table->string('filename')->nullable();
            $table->string('slug');
            $table->string('size')->nullable();
            $table->string('url')->nullable();
            $table->integer('views')->default(0);
            $table->string('type')->nullable();
            $table->string('embed_id')->nullable();
            $table->string('video_thumb')->nullable();
            $table->string('audio_thumb')->nullable();
            $table->unsignedInteger('gallery_category_id')->nullable();
            $table->integer('download_count')->default(0);
            $table->timestamp('last_download_time')->nullable();
            $table->timestamp('published_at')->nullable();
            $table->enum('gallery_type',['photo','video','audio','embedded']);
            $table->boolean('featured')->default(false);
            $table->boolean('allow_comments')->default(true);
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
        Schema::dropIfExists('galleries');
    }
}
