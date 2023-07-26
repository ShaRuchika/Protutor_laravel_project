<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hourly_rate extends Model
{
    use HasFactory;
    protected $fillable = [
        'hourly_rate', 'created_at', 'updated_at',
    ];
}
