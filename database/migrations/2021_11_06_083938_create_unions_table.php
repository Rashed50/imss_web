<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unions', function (Blueprint $table) {
          $table->id('UnioId');
          $table->string('UnioName',50);

          $table->unsignedBigInteger('DiviId');
          $table->unsignedBigInteger('DistId');
          $table->unsignedBigInteger('ThanId');
          
          $table->foreign('DiviId')->references('DiviId')->on('divisions')->onDelete('cascade');
          $table->foreign('DistId')->references('DistId')->on('districts')->onDelete('cascade');
          $table->foreign('ThanId')->references('ThanId')->on('thanas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('unions');
    }
}
