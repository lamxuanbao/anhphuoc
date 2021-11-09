<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocaleTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locale_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('locale_id')->unsigned();
            $table->string('locale', 20);
            $table->string('name')->nullable();
            $table->unique(['locale_id', 'locale']);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('locale_translations');
    }
}
