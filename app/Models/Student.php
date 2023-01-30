<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'person_id', 'created_at', 'updated_at'
    ];

    public function person()
    {
        return $this->belongsTo(Person::class, 'person_id');
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }
}
