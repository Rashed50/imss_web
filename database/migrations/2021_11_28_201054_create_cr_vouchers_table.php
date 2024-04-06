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
            $table->integer('CrTypeId')->unsigned()->nullable();;
            $table->date('CrDate');
            $table->float('CrAmount',11,2); 
            $table->string('CrVoucherNo');
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
        Schema::dropIfExists('cr_vouchers');
    }
}
