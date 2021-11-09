<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PropertyTranslations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'property_translations',
            function (Blueprint $table) {
                $table->id();
                $table->string('locale', 20);
                $table->string('name');
                $table->longText('content');
                $table->bigInteger('property_id')
                      ->unsigned();
                $table->unique(['property_id', 'locale']);
                $table->index(['property_id', 'locale']);
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('property_translations');
    }
}
