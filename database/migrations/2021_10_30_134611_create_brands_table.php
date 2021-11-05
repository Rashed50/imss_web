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
            $table->boolean('BranStatus')->default(true);
            $table->foreign('CateId')->references('CateId')->on('categories')->onDelete('cascade');
            $table->timestamps();
        //    $table->id();
        //    $table->string('product_type_name')->unique();
        //    $table->boolean('is_active');
        //    $table->unsignedBigInteger('provider_id');
        //    $table->unsignedBigInteger('service_type_id');
        //   $table->foreign('provider_id')->references('id')->on('service_providers');
        //   $table->foreign('service_type_id')->references('id')->on('service_types');



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
