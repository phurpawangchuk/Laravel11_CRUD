<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    // protected $table = 'students';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'course_id', // The unique code for the course
        'grade',       // The grade for the course, nullable
        'gender',
        'credits',
        'category',    // The category of the course
        'repeat',      // Whether the course is a repeat (boolean)
        'user_id',     // The user id of the student
    ];

     public function course()
    {
        return $this->belongsTo(Course::class); // A student belongs to one course
    }
}