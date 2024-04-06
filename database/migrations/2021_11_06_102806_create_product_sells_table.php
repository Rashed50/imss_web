<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductSellsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_sells', function (Blueprint $table) {
            $table->id('ProdSellId');
            $table->float('Commission',11,2)->default(0); // discount
            $table->float('TotalAmount',11,2)->default(0);
            $table->float('NetAmount',11,2)->default(0);
            $table->float('DueAmount',11,2)->default(0);
            $table->float('PaidAmount',11,2)->default(0);
            $table->float('LabourCost',11,2)->default(0);
            $table->date('SellingDate');
            $table->string('VoucharNo',15)->default(0);
            $table->float('CarryingCost',11,2)->default(0);
            $table->boolean('status')->default(1); 
            $table->integer('CreateById');
            $table->integer('UpdateById')->nullable();
            $table->timestamps();

            $table->unsignedBigInteger('TranId');
            $table->unsignedBigInteger('CustId');


            $table->foreign('TranId')->references('TranId')->on('transactions');//->onDelete('cascade');
            $table->foreign('CustId')->references('CustId')->on('customer_infos');//->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_sells');
    }
}
