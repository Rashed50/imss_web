<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductSellRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_sell_records', function (Blueprint $table) {
            $table->id('ProdSellRecoId');
            $table->integer('Quantity')->nullable();
            $table->float('Amount',11,2)->nullable();
            $table->float('LabourCost',11,2)->nullable();
            $table->boolean('status')->default(1);

            $table->unsignedBigInteger('ProdSellId');
            $table->unsignedBigInteger('CateId');
            $table->unsignedBigInteger('BranId');
            $table->unsignedBigInteger('SizeId');
            $table->unsignedBigInteger('ThicId');
            /* Foreign Key */
            // $table->foreign('ProdSellId')->references('ProdSellId')->on('product_sells')->onDelete('cascade');
            // $table->foreign('CateId')->references('CateId')->on('categories')->onDelete('cascade');
            // $table->foreign('BranId')->references('BranId')->on('brands')->onDelete('cascade');
            // $table->foreign('SizeId')->references('SizeId')->on('sizes')->onDelete('cascade');
            // $table->foreign('ThicId')->references('ThicId')->on('thicknesses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_sell_records');
    }
}
