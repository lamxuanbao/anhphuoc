<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepositImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deposit_images', function (Blueprint $table) {
            $table->id();
            $table->string('disk');
            $table->string('name');
            $table->string('path');
            $table->string('extension');
            $table->string('mime');
            $table->string('size');
            $table->bigInteger('deposit_id')
                  ->unsigned()
                  ->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('deposit_images');
    }
}
