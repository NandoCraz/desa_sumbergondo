<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

class Booking extends Model
{
    use HasFactory, Uuid;

    protected $guarded = ["uuid"];

    public function pelayanan()
    {
        return $this->belongsToMany(Pelayanan::class, 'booking_pelayanans');
    }

    public function barang()
    {
        return $this->belongsToMany(Barang::class, 'barang_bookings');
    }

    public function montir()
    {
        return $this->belongsTo(Montir::class);
    }
}
