<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commission_Setting extends Model
{
    use HasFactory;
    protected $table = 'commission_settings';
    protected $fillable = [
        'transaction_type', 'lesson_fees', 'class_fees', 'created_at', 'updated_at',
    ];
}
