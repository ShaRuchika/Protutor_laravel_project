<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Social_platform extends Model
{
    use HasFactory;
    protected $table = 'social_media_platform';
    protected $fillable = [
        'title', 'url', 'user_status', 'created_at', 'updated_at',
    ];
}
