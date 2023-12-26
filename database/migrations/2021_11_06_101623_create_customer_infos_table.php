<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateCustomerInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_infos', function (Blueprint $table) {
            $table->id('CustId');
            $table->string('CustName',50);
            $table->string('CustNameBl',50)->nullable();
            $table->string('TradeName');
            $table->string('TradeNameBl')->nullable();
            $table->integer('CustTypeId');
            $table->string('ContactNumber',15);
            $table->text('Address')->nullable();
            $table->float('DueAmount')->default(0);
            $table->float('InitialDue')->default(0);
            $table->string('Photo')->nullable();
            $table->string('FatherName',50)->nullable();
            $table->string('NID',30)->nullable();
            $table->unsignedBigInteger('CreateById');
            $table->boolean('status')->default(1);
            $table->timestamps();

            $table->unsignedBigInteger('DiviId');
            $table->unsignedBigInteger('DistId');
            $table->unsignedBigInteger('ThanId');
            $table->unsignedBigInteger('UnioId');

            // $table->foreign('DiviId')->references('DiviId')->on('divisions')->onDelete('cascade');
            // $table->foreign('DistId')->references('DistId')->on('districts')->onDelete('cascade');
            // $table->foreign('ThanId')->references('ThanId')->on('thanas')->onDelete('cascade');
            // $table->foreign('UnioId')->references('UnioId')->on('unions')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customer_infos');
    }
}
