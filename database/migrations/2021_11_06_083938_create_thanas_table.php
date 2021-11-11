<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateThanasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('thanas', function (Blueprint $table) {
            $table->id('ThanId');
            $table->string('ThanaName',50);
            $table->unsignedBigInteger('DiviId');
            $table->unsignedBigInteger('DistId');

            $table->foreign('DiviId')->references('DiviId')->on('divisions')->onDelete('cascade');
            $table->foreign('DistId')->references('DistId')->on('districts')->onDelete('cascade');
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
        Schema::dropIfExists('thanas');
    }
}
