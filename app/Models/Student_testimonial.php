<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student_testimonial extends Model
{
    use HasFactory;
    protected $table = 'student_testimonial';


    protected $fillable = ['student_name','student_desc','student_image', 'student_rating', 'user_status'];
}
