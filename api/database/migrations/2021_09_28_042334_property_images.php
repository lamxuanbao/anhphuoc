<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PropertyImages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'property_images',
            function (Blueprint $table) {
                $table->id();
                $table->string('disk');
                $table->string('name');
                $table->string('path');
                $table->string('extension');
                $table->string('mime');
                $table->string('size');
                $table->bigInteger('property_id')
                      ->unsigned();
                $table->index(['property_id']);
                $table->timestamps();
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
        Schema::drop('property_images');
    }
}
