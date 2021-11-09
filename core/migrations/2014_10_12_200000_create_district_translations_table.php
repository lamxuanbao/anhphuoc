<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDistrictTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('district_translations', function (Blueprint $table) {
            $table->id();
            $table->string('locale', 20);
            $table->string('type');
            $table->string('name');
            $table->bigInteger('district_id')
                ->unsigned();
            $table->unique(['district_id', 'locale']);
            $table->index(['district_id', 'locale']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('district_translations');
    }
}
