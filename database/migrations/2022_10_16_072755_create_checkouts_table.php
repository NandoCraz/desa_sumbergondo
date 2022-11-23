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
            $table->foreignId('daftar_alamat_id');
            $table->enum('status', ['Pending', 'Dikirim', 'Diterima'])->default('Pending');
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
