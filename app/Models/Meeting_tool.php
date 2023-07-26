<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meeting_tool extends Model
{
    use HasFactory;
    protected $table = 'meeting_tools';
    protected $fillable = [
        'code', 'info', 'api_key', 'api_id', 'api_script', 'created_at', 'updated_at',
    ];
}
