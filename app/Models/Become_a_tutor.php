<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Become_a_tutor extends Model
{
    use HasFactory;
    protected $fillable = [
        'icon_sec1', 'title_sec1', 'content_sec1', 'created_at', 'updated_at',
    ];
}
