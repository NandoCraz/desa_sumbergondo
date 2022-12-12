<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

class Checkout extends Model
{
    use HasFactory, Uuid;

    protected $guarded = ["uuid"];

    public function daftarAlamat()
    {
        return $this->belongsTo(DaftarAlamat::class);
    }

    public function pesanans()
    {
        return $this->hasMany(Pesanan::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
