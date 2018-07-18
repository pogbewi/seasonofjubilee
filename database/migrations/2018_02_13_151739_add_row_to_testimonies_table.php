<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRowToTestimoniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('testimonies', function (Blueprint $table) {
            $table->text('meta_description')->nullable();
            $table->text('meta_keywords')->nullable();
            $table->string('photo');
            $table->integer('views')->default(0);
            $table->timestamp('published_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('testimonies', function (Blueprint $table) {
           $table->dropColumn(['image','meta_description','meta_keywords','published_at', 'views']);
        });
    }
}
