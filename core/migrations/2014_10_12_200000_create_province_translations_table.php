<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProvinceTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('province_translations', function (Blueprint $table) {
            $table->id();
            $table->string('locale', 20);
            $table->string('type');
            $table->string('name');
            $table->bigInteger('province_id')->unsigned();
            $table->unique(['province_id', 'locale']);
            $table->index(['province_id','locale']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('province_translations');
    }
}
