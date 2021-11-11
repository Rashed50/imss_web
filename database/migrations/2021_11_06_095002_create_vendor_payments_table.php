<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendor_payments', function (Blueprint $table) {
            $table->id('VendPaymId');
            $table->unsignedBigInteger('TranId');
            $table->unsignedBigInteger('VendId');
            $table->date('Date');
            $table->float('Amount',2);
            $table->integer('DebitToId')->nullable();
            $table->integer('CreditToId')->nullable();
            $table->string('CheckNo',50)->nullable();
            $table->integer('BankId')->nullable();
            $table->integer('PaymentTypeId')->nullable();
            $table->unsignedBigInteger('CreateById');
            $table->boolean('status')->default(1);
            $table->timestamps();
            /* Foreign Key */
            $table->foreign('TranId')->references('TranId')->on('transactions')->onDelete('cascade');
            $table->foreign('VendId')->references('VendId')->on('vendors')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vendor_payments');
    }
}
