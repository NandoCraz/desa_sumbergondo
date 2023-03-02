<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

class Kategori extends Model
{
    use HasFactory, Uuid;

    protected $guarded = ["uuid"];

    // public function barang()
    // {
    //     return $this->hasMany(Barang::class);
    // }

    public function barang()
    {
        return $this->belongsToMany(Barang::class, 'barang_kategoris');
    }
}
