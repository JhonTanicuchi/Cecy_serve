<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Career extends Model
{
    protected $table = 'careers';

    protected $fillable = [
        'id', 'name', 'created_at', 'updated_at'
    ];

    public function course()
    {
        return $this->hasMany(Course::class);
    }
}
