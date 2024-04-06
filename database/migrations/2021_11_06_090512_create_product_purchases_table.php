<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductPurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_purchases', function (Blueprint $table) {
            $table->id('ProdPurcId');
            $table->unsignedBigInteger('TransactionId');
            $table->float('TotalPrice',11,2)->default(0);
            $table->date('PurchaseDate');
            $table->integer('VendorId');
            $table->float('LabourCost',11,2)->default(0);
            $table->integer('PaymentType');
            $table->integer('BankId')->nullable();
            $table->integer('Discount')->default(0);
            $table->integer('CarringCost')->default(0);
            $table->integer('ToSaleId')->default(0);
            $table->string('DoNo',40)->nullable();
            $table->string('TruckNo',40)->nullable();
            $table->integer('CreateById');
            $table->integer('UpdateById')->nullable();
            $table->boolean('status')->default(1);
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
        Schema::dropIfExists('product_purchases');
    }
}
