<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Barang;
use App\Models\KeranjangDetail;
use App\Traits\Uuid;

class Keranjang extends Model
{
    use HasFactory, Uuid;

    protected $guarded = ["id", "uuid"];
    protected $appends = ['subtotal'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }

    public function getSubtotalAttribute() {
        return $this->kuantitas * $this->barang->harga;
    }
}
