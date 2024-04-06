<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLabourRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('labour_rates', function (Blueprint $table) {
            $table->id('LaboId');
            $table->unsignedBigInteger('CateId');
            $table->unsignedBigInteger('BranId');
            $table->unsignedBigInteger('SizeId');
            $table->string('LaboType',6); // load , unload
            $table->float('Amount')->default(0);

            $table->integer('CreateById')->unsigned();
            $table->integer('UpdateById')->unsigned()->nullable();

            $table->foreign('CateId')->references('CateId')->on('categories');
            $table->foreign('BranId')->references('BranId')->on('brands');
            $table->foreign('SizeId')->references('SizeId')->on('sizes');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('labour_rates');
    }
}
