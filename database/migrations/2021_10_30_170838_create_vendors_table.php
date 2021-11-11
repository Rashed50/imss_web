<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendors', function (Blueprint $table) {
            $table->id('VendId');
            $table->string('VendName');
            $table->string('ContactName')->nullable();
            $table->string('VendAddress')->nullable();
            $table->string('Mobile1')->nullable();
            $table->double('Balance',10,2)->default(0);
            $table->double('InitialBalance',10,2)->default(0);
            $table->date('OpeningDate');
            $table->boolean('ActiveStatus')->default(true);
            $table->timestamps();
            $table->unsignedBigInteger('ChartOfAcctId');
            // $table->foreign('ChartOfAcctId')->references('ChartOfAcctId')->on('chart_of_accounts');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vendors');
    }
}
