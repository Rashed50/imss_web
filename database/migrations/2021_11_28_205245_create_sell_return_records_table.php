<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSellReturnRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sell_return_records', function (Blueprint $table) {
            $table->id('SellRetuRecoId');
            $table->unsignedBigInteger('SellRetuId');
            $table->unsignedBigInteger('ProductListId');
            $table->integer('Quantity');
            $table->float('Amount',11,2);
            $table->float('LabourCost',11,2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sell_return_records');
    }
}
