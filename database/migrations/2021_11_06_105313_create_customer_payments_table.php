<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_payments', function (Blueprint $table) {
            $table->id('CustPaymId');
            $table->date('PaymentDate')->nullable();
            $table->float('PaymentAmount',2);
            $table->unsignedBigInteger('AccountId');
            $table->unsignedBigInteger('MoneyReciveBy')->nullable();
            $table->string('VoucharNo',50)->nullable();
            $table->float('Discount',2)->nullable();
            $table->unsignedBigInteger('CreateById');
            $table->boolean('status')->default(1);
            $table->timestamps();
            $table->unsignedBigInteger('CustId');
            $table->unsignedBigInteger('TranId');
            /* Foreign Key */
            $table->foreign('CustId')->references('CustId')->on('customer_infos')->onDelete('cascade');
            $table->foreign('TranId')->references('TranId')->on('transactions')->onDelete('cascade');



        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customer_payments');
    }
}
