<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBrandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brands', function (Blueprint $table) {
            $table->id('BranId');
            $table->unsignedBigInteger('CateId');
            $table->string('BranName');
            $table->string('BranBlName');
            $table->boolean('BranStatus')->default(true);
            $table->foreign('CateId')->references('CateId')->on('categories')->onDelete('cascade');
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
        Schema::dropIfExists('brands');
    }
}
