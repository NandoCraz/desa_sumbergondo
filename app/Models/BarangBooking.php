<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

class BarangBooking extends Model
{
    use HasFactory, Uuid;

    protected $guarded = ['uuid'];
}
