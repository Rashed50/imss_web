<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSellReturnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sell_returns', function (Blueprint $table) {
            $table->id('SellRetuId');
            $table->unsignedBigInteger('TransactionId');
            $table->float('Commision',11,2)->default(0);
            $table->float('TotalAmount',11,2)->default(0);
            $table->float('NetAmount',11,2)->default(0);
            $table->float('DueAmount',11,2)->default(0);
            $table->float('PaidAmount',11,2)->default(0);
            $table->float('LabourCost',11,2)->default(0);
            $table->string('PaidType',20);
            $table->date('ReturnDate');
            $table->unsignedBigInteger('CustId');
            $table->unsignedBigInteger('StaffId');
            $table->integer('SellId');
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
        Schema::dropIfExists('sell_returns');
    }
}
