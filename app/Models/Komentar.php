<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

class Komentar extends Model
{
    use HasFactory, Uuid;

    protected $guarded = ["uuid"];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
