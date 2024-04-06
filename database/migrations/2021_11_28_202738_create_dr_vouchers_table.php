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
          $table->integer('DrTypeId')->unsigned()->nullable();
          $table->date('DrDate');
          $table->float('DrAmount',11,2); 
          $table->string('DrVoucherNo');
          $table->unsignedBigInteger('CreateById');
          $table->unsignedBigInteger('UpdateById')->nullable();
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
