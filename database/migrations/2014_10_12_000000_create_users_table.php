<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->uuid()->unique();
            $table->foreignId('bank_id');
            $table->foreignId('rw_id')->nullable();
            $table->foreignId('rt_id')->nullable();
            $table->string('name');
            $table->double('saldo_bank')->default(0);
            $table->double('tagihan_komposter')->default(0);
            $table->string('username');
            $table->string('email')->unique();
            $table->string('no_hp');
            $table->string('picture_profile')->nullable();
            $table->string('role');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
