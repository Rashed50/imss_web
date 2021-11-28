<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerIntialDuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_intial_dues', function (Blueprint $table) {
            $table->id('CustIntiDuesId');
            $table->float('DueAmount',11,2);
            $table->integer('Year');
            $table->date('EntryDate');
            $table->unsignedBigInteger('CustId');
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
        Schema::dropIfExists('customer_intial_dues');
    }
}
