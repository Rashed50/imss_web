<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Hash;


class CreateUsersTable extends Migration
{
    //
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('user_name');
            $table->string('user_email')->unique();
            $table->string('user_phone')->nullable();
            $table->string('profile_photo')->nullable();
            $table->integer('user_type')->default(1);
            $table->integer('status')->default(1);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        DB::table('users')->insert([
            'user_name' => 'rashed' ,
            'user_email' => 'admin@gmail.com' ,
            'user_phone' => '01731540704',
            'user_type' => 1,
            'password' => Hash::make("123456"), // 123456789
        ]);
//spatie/laravel-html
//composer require spatie/laravel-permission


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
