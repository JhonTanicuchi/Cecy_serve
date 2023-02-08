<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;

class CoursesController extends Controller
{
    public function getCourses()
    {
        $courses = Course::all();
        return response()->json($courses);
    }
}
