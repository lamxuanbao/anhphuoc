<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWardTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ward_translations', function (Blueprint $table) {
            $table->id();
            $table->string('locale', 20);
            $table->string('type');
            $table->string('name');
            $table->bigInteger('ward_id')->unsigned();
            $table->unique(['ward_id', 'locale']);
            $table->index(['ward_id','locale']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ward_translations');
    }
}
