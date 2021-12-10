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
            $table->unsignedBigInteger('SizeId');
            $table->string('LaboType',6); // load , unload
            $table->float('Amount')->default(0);
            $table->foreign('CateId')->references('CateId')->on('categories')->onDelete('cascade');
            $table->foreign('SizeId')->references('SizeId')->on('sizes')->onDelete('cascade');

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
