<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSMSPurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('s_m_s_purchases', function (Blueprint $table) {
            $table->id('SmsPurcId');
            $table->integer('PurchaseQuantity');
            $table->integer('TotalQuantity');
            $table->float('PaidAmount',11,2);
            $table->date('PurchaseDate');
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
        Schema::dropIfExists('s_m_s_purchases');
    }
}
