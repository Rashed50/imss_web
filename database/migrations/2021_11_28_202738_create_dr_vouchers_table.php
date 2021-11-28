<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDrVouchersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dr_vouchers', function (Blueprint $table) {
          $table->id('DrVoucId');
          $table->unsignedBigInteger('TransactionId');
          $table->unsignedBigInteger('DrTypeId');
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
        Schema::dropIfExists('dr_vouchers');
    }
}
