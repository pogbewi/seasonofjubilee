<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeyToSermonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sermons', function (Blueprint $table) {
            $table->foreign('sermon_category_id')->references('id')->on('sermon_categories');
        });

        Schema::table('sermons', function (Blueprint $table) {
            $table->foreign('service_id')->references('id')->on('services')
                ->onDelete('restrict')
                ->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sermons', function (Blueprint $table) {
            $table->dropForeign(['sermon_category_id']);
        });

        Schema::table('sermons', function (Blueprint $table) {
            $table->dropForeign(['service_id']);
        });
    }
}
