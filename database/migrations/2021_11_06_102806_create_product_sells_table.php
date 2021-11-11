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
            $table->float('Commission',2)->nullable();
            $table->float('TotalAmount',2)->nullable();
            $table->float('NetAmount',2)->nullable();
            $table->float('DueAmount',2)->nullable();
            $table->float('PaidAmount',2)->nullable();
            $table->float('LabourCost',2)->nullable();
            $table->date('SellingDate')->nullable();
            $table->string('VoucharNo',15)->nullable();
            $table->float('CarryingCost',2);
            $table->boolean('status')->nullable();
            $table->unsignedBigInteger('CreateById');
            $table->timestamps();

            $table->unsignedBigInteger('TranId');
            $table->unsignedBigInteger('CustId');


            $table->foreign('TranId')->references('TranId')->on('transactions')->onDelete('cascade');
            $table->foreign('CustId')->references('CustId')->on('customer_infos')->onDelete('cascade');
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
