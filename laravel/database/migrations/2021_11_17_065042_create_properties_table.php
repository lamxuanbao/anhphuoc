<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'properties',
            function (Blueprint $table) {
                $table->id();
                $table->bigInteger('province_id')
                      ->unsigned()
                      ->index();
                $table->enum('type', ['buy', 'rent'])
                      ->default('buy');
                $table->string('name');
                $table->longText('content');
                $table->bigInteger('property_id')
                      ->unsigned();
                $table->longText('keywords')
                      ->nullable();
                $table->longText('description')
                      ->nullable();
                $table->decimal('area', 10, 2);
                $table->bigInteger('price');
                $table->boolean('is_active')
                      ->default(false);
                $table->boolean('is_default')
                      ->default(false);
                $table->bigInteger('created_by')
                      ->nullable()
                      ->unsigned()
                      ->index();
                $table->longText('slug');
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
        Schema::dropIfExists('properties');
    }
}
