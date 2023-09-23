<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

class Tetangga extends Model
{
    use HasFactory, Uuid;

    protected $guarded = ["uuid"];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pengolahan()
    {
        return $this->belongsTo(Pengolahan::class, 'rt_id');
    }
}
