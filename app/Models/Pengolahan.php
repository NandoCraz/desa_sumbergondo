<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

class Pengolahan extends Model
{
    use HasFactory, Uuid;

    protected $guarded = ["uuid"];

    public function warga()
    {
        return $this->belongsTo(Warga::class, 'rw_id');
    }

    public function tetangga()
    {
        return $this->belongsTo(Tetangga::class, 'rt_id');
    }
}
