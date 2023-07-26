<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Support extends Model
{
    use HasFactory;
    protected $table = 'supports';
    protected $fillable = [
        'support_sec1', 'support_sec2', 'live_chat', 'call_us', 'mail', 'created_at', 'updated_at',
    ];
}
