<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCrVouchersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cr_vouchers', function (Blueprint $table) {
            $table->id('CrVoucId');
            $table->unsignedBigInteger('TransactionId');
            $table->unsignedBigInteger('CrTypeId');
            $table->date('ExpenseDate');
            $table->float('Amount',11,2);
            $table->integer('DebitedTold');
            $table->integer('CreditedFromId');
            $table->string('VoucherId');
            $table->unsignedBigInteger('CreateById');
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
        Schema::dropIfExists('cr_vouchers');
    }
}
