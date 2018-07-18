<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGiveTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('give', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('type', ['offering','tithe','first fruit','other']);
            $table->decimal('amount', 6, 4);
            $table->string('name');
            $table->string('phone')->nullable();
            $table->string('email')->nulable();
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
        Schema::dropIfExists('give');
    }
}
