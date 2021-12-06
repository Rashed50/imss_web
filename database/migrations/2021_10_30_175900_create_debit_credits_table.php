<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDebitCreditsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('debit_credits', function (Blueprint $table) {
            $table->id('DebiCredId');
            $table->float('Amount',10,2);
            $table->unsignedBigInteger('TranId');
            $table->unsignedBigInteger('ChartOfAcctId');
            $table->unsignedBigInteger('DrCrTypeId');
            
            $table->foreign('TranId')->references('TranId')->on('transactions');
            $table->foreign('ChartOfAcctId')->references('ChartOfAcctId')->on('chart_of_accounts');
            $table->foreign('DrCrTypeId')->references('DrCrTypeId')->on('dr_cr_types');
            
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('debit_credits');
    }
}
