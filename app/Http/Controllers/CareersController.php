<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Career;

class CareersController extends Controller
{
    public function getCareers()
    {
        $careers = Career::all();
        return response()->json($careers);
    }
}
