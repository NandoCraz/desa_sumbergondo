<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\SoftDeletes;

class Booking extends Model
{
    use HasFactory, SoftDeletes, Uuid;

    protected $guarded = ["uuid"];

    public function pelayanan()
    {
        return $this->belongsToMany(Pelayanan::class, 'booking_pelayanans')->withPivot('id');
    }

    public function barang()
    {
        return $this->belongsToMany(Barang::class, 'barang_bookings')->withPivot('kuantitas', 'id');
    }

    public function montir()
    {
        return $this->belongsTo(Montir::class);
    }

    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class);
    }
}
