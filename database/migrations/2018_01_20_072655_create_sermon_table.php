<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSermonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sermons', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('preacher')->nullable();
            $table->integer('sermon_category_id')->unsigned();
            $table->integer('service_id')->unsigned()->nullable()->default(null);
            $table->date('preached_on')->nullable();
            $table->text('excerpt');
            $table->text('body');
            $table->text('meta_description')->nullable();
            $table->text('meta_keywords')->nullable();
            $table->string('free')->default('true');
            $table->boolean('allow_comments')->default(true);
            $table->integer('views')->default(0);
            $table->string('slug')->unique();
            $table->timestamp('scheduled_on')->nullable();
            $table->softdeletes();
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
        Schema::dropIfExists('sermons');
    }
}
