<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

class Barang extends Model
{
    use HasFactory, Uuid;

    protected $guarded = ["uuid"];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function booking()
    {
        return $this->belongsToMany(Booking::class, 'barang_bookings')->withPivot('id');
    }
}
