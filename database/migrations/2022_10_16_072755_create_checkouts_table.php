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
        Schema::create('checkouts', function (Blueprint $table) {
            $table->id();
            $table->uuid()->unique();
            $table->foreignId('user_id');
            $table->string('snap_token')->nullable();
            $table->foreignId('daftar_alamat_id');
            $table->enum('payment_status', ['1', '2', '3', '4'])->default('1')->comment('1=Menunggu Pembayaran, 2=Sudah Dibayar, 3=Kadaluarsa');
            $table->enum('status', ['1', '2', '3', '4'])->comment('1=Menunggu Konfirmasi, 2=Sedang Diproses, 3=Dikirim, 4=Selesai')->nullable();
            $table->enum('courier', ['jne', 'tiki', 'pos']);
            $table->string('layanan');
            $table->double('total');
            $table->double('ongkir');
            $table->integer('estimasi');
            $table->text('catatan')->nullable();
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
        Schema::dropIfExists('checkouts');
    }
};
