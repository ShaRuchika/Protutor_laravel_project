<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Footer extends Model
{
    use HasFactory;
    protected $table = 'footer';
    protected $fillable = [
        'icon', 'title', 'email', 'contact', 'copyright', 'desc1', 'desc2', 'created_at', 'updated_at',
    ];
}

