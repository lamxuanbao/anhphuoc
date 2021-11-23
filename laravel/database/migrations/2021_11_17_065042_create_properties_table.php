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
                $table->string('title');
                $table->longText('keywords')
                    ->nullable();
                $table->longText('description')
                    ->nullable();
                $table->text('address');
                $table->longText('content');
                $table->bigInteger('property_id')
                      ->unsigned();
                $table->decimal('area', 18, 2);
                $table->decimal('price', 18, 2);
                $table->boolean('is_active')
                      ->default(false);
                $table->bigInteger('user_id')
                      ->nullable()
                      ->unsigned()
                      ->index();
                $table->bigInteger('customer_id')
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
