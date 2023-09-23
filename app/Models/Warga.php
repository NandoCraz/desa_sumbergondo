<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

class Warga extends Model
{
    use HasFactory, Uuid;

    protected $guarded = ["uuid"];

    public function tetangga()
    {
        return $this->belongsTo(Tetangga::class);
    }

    public function pengolahan()
    {
        return $this->belongsTo(Pengolahan::class);
    }
}
