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
        Schema::create('barang_bookings', function (Blueprint $table) {
            $table->id();
            $table->uuid()->unique();
            $table->foreignId('booking_id')->nullable();
            $table->foreignId('barang_id')->nullable();
            $table->integer('kuantitas')->default('1')->nullable();
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
        Schema::dropIfExists('barang_bookings');
    }
};
