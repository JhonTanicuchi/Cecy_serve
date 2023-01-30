<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    use HasFactory;
    protected $table = 'enrollments';

    protected $fillable = [
        'id', 'student_id', 'career_id', 'course_id', 'date', 'state_id', 'type_enrollment_id', 'created_at', 'updated_at'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function career()
    {
        return $this->belongsTo(Career::class, 'career_id');
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function state()
    {
        return $this->belongsTo(Catalog::class, 'state_id');
    }

    public function typeEnrollment()
    {
        return $this->belongsTo(Catalog::class, 'type_enrollment_id');
    }
}
