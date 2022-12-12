<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

class Pesanan extends Model
{
    use HasFactory, Uuid;

    protected $guarded = ["uuid"];

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }

    public function checkout()
    {
        return $this->belongsTo(Checkout::class);
    }
}
