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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->uuid()->unique();
            $table->string('snap_token')->nullable();
            $table->foreignId('user_id');
            $table->foreignId('montir_id');
            $table->string('nama_pemesan');
            $table->string('alamat')->nullable();
            $table->string('no_telp')->nullable();
            $table->string('tipe_mobil');
            $table->text('kendala')->nullable();
            $table->dateTime('waktu');
            $table->string('tempat_perbaikan')->nullable();
            $table->string('tipe_bayar')->nullable();
            $table->string('status');
            $table->enum('payment_status', ['1', '2', '3', '4'])->default('1')->comment('1=Menunggu Pembayaran, 2=Sudah Dibayar, 3=Kadaluarsa, 4=Batal');
            $table->double('penawaran')->nullable();
            $table->string('status_penawaran')->nullable();
            $table->double('total')->nullable();
            $table->string('lampiran_1')->nullable();
            $table->string('lampiran_2')->nullable();
            $table->string('lampiran_3')->nullable();
            $table->string('lampiran_4')->nullable();
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
        Schema::dropIfExists('bookings');
    }
};
