<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

class Pelayanan extends Model
{
    use HasFactory, Uuid;

    protected $guarded = ["uuid"];

    public function booking()
    {
        return $this->belongsToMany(Booking::class, 'booking_pelayanans');
    }
}
