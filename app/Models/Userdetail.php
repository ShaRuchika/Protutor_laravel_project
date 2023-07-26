<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Userdetail extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $table = 'userdetails';
    protected $fillable = [
        'student_no',
        'first_name',
        'last_name',
        'country',
        'languages',
        'native_language',
        'level',
        'email',
        'over_18',
        'teaching_exp',
        'current_sit',
        'timezone',
        'phone',
        'hourly_rate',
        'subject',
        'profile_img',
        'desc_first_last',
        'desc_about',
        'video_link',
        'profile_verified',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
}
