<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $table = 'courses';

    protected $fillable = [
        'id', 'name', 'career_id', 'semester', 'created_at', 'updated_at'
    ];

    public function career()
    {
        return $this->belongsTo(Career::class);
    }
}
