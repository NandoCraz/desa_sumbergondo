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
        Schema::create('pelatihans', function (Blueprint $table) {
            $table->id();
            $table->uuid()->unique();
            $table->string('snap_token')->nullable();
            $table->foreignId('user_id');
            $table->string('nama_pemesan');
            $table->string('no_telp')->nullable();
            $table->dateTime('waktu');
            $table->string('tipe_bayar')->nullable();
            $table->double('total')->nullable();
            $table->string('status')->nullable();
            $table->enum('payment_status', ['1', '2', '3', '4'])->default('1')->comment('1=Menunggu Pembayaran, 2=Sudah Dibayar, 3=Kadaluarsa, 4=Batal');
            $table->softDeletes();
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
        Schema::dropIfExists('pelatihans');
    }
};
