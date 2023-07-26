<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teaches_level extends Model
{
    use HasFactory;
     protected $table = 'teaches_levels';
    protected $fillable = [
        'teaches_level', 'created_at', 'updated_at',
    ];
}
